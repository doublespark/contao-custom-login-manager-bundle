<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Controller;

use Contao\Environment;
use Contao\FilesModel;
use Contao\Input;
use Contao\StringUtil;
use Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginClientsModel;
use Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginMessagesModel;
use Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginPopupsModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * Class MessagesController
 *
 * @package Doublespark\ContaoCustomLoginManagerBundle\Controller
 */
class MessagesController extends AbstractController
{
    /**
     * Handle messages request
     */
    public function handleGetMessages()
    {
        return new JsonResponse([
            'messages' => $this->getMessages(),
            'popup'    => $this->getPopup()
        ]);
    }

    /**
     * Get the popup image
     * @return mixed|string|null
     */
    protected function getPopup()
    {
        $domain = Input::get('domain');

        $popUpUrl = null;

        if($domain)
        {
            $cache = $this->container->get('doublespark.custom-login-manager.popups-cache');

            /**
             * @var ItemInterface $popupCache
             */
            $popupCache = $cache->getItem($this->getCacheKey($domain));

            if($popupCache->isHit())
            {
                $popUpUrl = $popupCache->get();
            }
            else
            {
                $this->container->get('contao.framework')->initialize();

                $objClient = DsLoginClientsModel::findOneByDomain($domain);

                if($objClient AND !empty($objClient->popup))
                {
                    $objPopUp = DsLoginPopupsModel::findByPk($objClient->popup);

                    if($objPopUp AND $objPopUp->published)
                    {
                        $rootDir = $this->container->getParameter('kernel.project_dir');

                        $objFile = FilesModel::findByUuid($objPopUp->singleSRC);

                        if(!is_null($objFile) AND is_file($rootDir.'/'.$objFile->path))
                        {
                            $popUpUrl = Environment::get('url').'/'.$objFile->path;

                            $popupCache->set($popUpUrl);
                            $cache->save($popupCache);
                        }
                    }
                }
            }
        }

        return $popUpUrl;
    }

    /**
     * Get the messages
     * @return array
     */
    protected function getMessages()
    {
        $audience = Input::get('audience');

        $cache = $this->container->get('doublespark.custom-login-manager.messages-cache');

        /**
         * @var ItemInterface $messagesCache
         */
        $messagesCache = $cache->getItem($this->getCacheKey($audience));

        // Messages that we want to cache
        $arrMessagesCache = [];

        if($messagesCache->isHit())
        {
            $arrMessagesCache = $messagesCache->get();
        }
        else
        {
            $this->container->get('contao.framework')->initialize();

            $objMessages = DsLoginMessagesModel::findBy('published',1, ['order' => 'createdAt DESC']);

            if($objMessages)
            {
                while($objMessages->next())
                {
                    $message = [
                        'id'          => StringUtil::substr(md5($objMessages->id),5,''),
                        'createdAt'   => $objMessages->createdAt,
                        'start'       => $objMessages->start,
                        'stop'        => $objMessages->stop,
                        'messageText' => $objMessages->messageText,
                        'sticky'      => $objMessages->sticky
                    ];

                    if(!is_null($audience))
                    {
                        if($objMessages->messageAudience === $audience || $objMessages->messageAudience === 'all')
                        {
                            $arrMessagesCache[] = $message;
                        }
                    }
                    else
                    {
                        $arrMessagesCache[] = $message;
                    }
                }
            }

            $messagesCache->set($arrMessagesCache);
            $cache->save($messagesCache);
        }

        // Messages to include in response
        $arrMessages = [];
        $now         = time();

        // Filter out by start/stop date
        foreach($arrMessagesCache as $message)
        {
            if((!empty($message['start']) AND $message['start'] >= $now) || (!empty($message['stop']) AND $message['stop'] <= $now))
            {
                continue;
            }

            $arrMessages[] = [
                'id'          => $message['id'],
                'createdAt'   => $message['createdAt'],
                'messageText' => $message['messageText'],
                'sticky'      => (bool)$message['sticky']
            ];
        }

        return $arrMessages;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getCacheKey($key)
    {
        if($key)
        {
            return 'custom-login.item.'.$key;
        }

        return 'custom-login.item';
    }

    /**
     * Log error
     * @param $strMessage
     */
    protected function error($strMessage)
    {
        $logger = $this->container->get('monolog.logger.contao');
        $logger->log(LogLevel::ERROR, $strMessage, array('contao' => new ContaoContext('Doublespark\ContaoCustomLoginManagerBundle\Controller\MessagesController::handleGetMessages', 'TL_ERROR')));
    }

    /**
     * Log info message
     * @param $strMessage
     */
    protected function info($strMessage)
    {
        $logger = $this->container->get('monolog.logger.contao');
        $logger->log(LogLevel::INFO, $strMessage, array('contao' => new ContaoContext('Doublespark\ContaoCustomLoginManagerBundle\Controller\MessagesController::handleGetMessages', 'TL_INFO')));
    }
}
