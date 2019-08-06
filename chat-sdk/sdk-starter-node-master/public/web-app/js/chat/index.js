$(function() {

  // Get handle to the chat div
  var $chatWindow = $('#messages');
  var $chatContainer = $('#chat-container');



  // Our interface to the Chat service
  var chatClient;

  // A handle to the chat channel - the one and only channel we
  // will have in this sample app
  var generalChannel;

  // The server will assign the client a random username - store that value
  // here
  var username;

  var channelName = generateHash(15);

  

  // Helper function to print info messages to the chat window
  function generateHash(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        console.log(result);
        return result;
    }

  

  // Helper function to print chat message to the chat window
  function printMessage(fromUser, message) {

    var currentDate = moment().format('hh:mm A');

    console.log(currentDate);

    if (fromUser === 'system') {
       
        var $message = $('<li class="clearfix">' +
                            '<div class="message-data align-right">' +
                            '<span class="message-data-time" >' + currentDate + ', Today</span> &nbsp; &nbsp;' +
                            '<span class="message-data-name" >Happy Times</span> <i class="fa fa-circle me"></i>' +
                            '</div>' +
                            '<div class="message other-message float-right">' + message +  '</div>'+
                          '</li>');
    }else{
        if(message == 'happy')
            return;

        var $message = $('<li>' +
        '<div class="message-data">' +
        '  <span class="message-data-name"><i class="fa fa-circle online"></i> You</span>' +
        '  <span class="message-data-time">' + currentDate + ', Today</span>' +
        '</div>' +
        '<div class="message my-message">' + message + '</div>' +
      '</li>');
        
    }
    $chatWindow.append($message);
    $chatContainer.scrollTop($chatContainer[0].scrollHeight);
    
  }

  // Alert the user they have been assigned a random username
 // print('Logging in...');

  // Get an access token for the current user, passing a username (identity)
  // and a device ID - for browser-based apps, we'll always just use the
  // value "browser"
  $.getJSON('/token', {
    device: 'browser'
  }, function(data) {


    // Initialize the Chat client
    Twilio.Chat.Client.create(data.token).then(client => {
      console.log('Created chat client');
      chatClient = client;
      chatClient.getSubscribedChannels().then(createOrJoinGeneralChannel);

    // Alert the user they have been assigned a random username
    username = data.identity;
   // print('You have been assigned a random username of: '
   // + '<span class="me">' + username + '</span>', true);

    }).catch(error => {
      console.error(error);
      
    });
  });

  function createOrJoinGeneralChannel() {
    // Get  chat channel, which is where all the messages are
    // sent in this simple application
   
    chatClient.getChannelByUniqueName(channelName)
    .then(function(channel) {
      generalChannel = channel;
      console.log('Found  channel:');
      console.log(generalChannel);
      setupChannel();
    }).catch(function() {
      // If it doesn't exist, let's create it
      console.log('Creating  channel');
      chatClient.createChannel({
        uniqueName: channelName,
        friendlyName: channelName
      }).then(function(channel) {
        console.log('Created  channel:' + channelName);
        console.log(channel);
        generalChannel = channel;
        setupChannel();


      }).catch(function(channel) {
        console.log('Channel could not be created:');
        console.log(channel);
      });
    });
  }

  // Set up channel after it has been found
  function setupChannel() {
    // Join the  channel
    generalChannel.join().then(function(channel) {
        generalChannel.sendMessage('happy');
    });

    // Listen for new messages sent to the channel
    generalChannel.on('messageAdded', function(message) {
      printMessage(message.author, message.body);
    });
  }

  // Send a new message to the  channel
  var $input = $('#chat-input');
  $input.on('keydown', function(e) {

    if (e.keyCode == 13) {
      if (generalChannel === undefined) {
        console.log('The Chat Service is not configured. Please check your .env file.');
        return;
      }
      generalChannel.sendMessage($input.val())
      $input.val('');
    }
  });
  
});

