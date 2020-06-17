# Doublespark Contao Custom Login Manager
A companion bundle for the custom login screen bundle for remotely managing the custom login screen content.

## Usage
In the CMS there are 3 sections:

### Messages
Messages can be managed in the CMS under *Messages* on the main menu. Any messages here will be displayed on the custom login screens.

The message audience controls whether they are shown on DS branded, TF branded or both login screens.

Messages can be made "Sticky" to make them more prominent keep them visible.

### Clients
Here is where clients can be defined which is required for use of pop-ups. Each client has the following fields:

| Field       | Description                                                    |
|:------------|:---------------------------------------------------------------|
|Name         | The name of the client.                                        |
|Domain       | The client's website domain. Should not include the protocol.  |
|Pop-up       | The pop-up which show be shown to this client.                 |

### Pop-ups
Pop-ups can be managed here, a pop-up is an image that is shown on the login screen. In order for a pop-up to work it has to be assigned to a client (see section above).


