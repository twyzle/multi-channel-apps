# Building Transformative Multi-Channel Apps with Twilio


In this workshop we are going to build a multi-channal app for Happy Times Pizza.  Our app is going to allow a user to 

1. Make a reservation
2. Submit a review
3. Get location information
4. Get business hours

We will make our app will be available via text, voice and from the happy times website. Our main canvas for building our app is going to be Twilio Autopilot.  We are going to use these additional other Twilio technologies to make our app accessible across multiple channels : Programmable Voice, Programmable SMS, Programmable Chat, Twilio Client, Twilio Functions, Twilio Studio

This repo contains all of the resources you will need to build this app. The steps to complete it are listed below.   Estimated time to complete is 1 HR. 

### Step 1 - Creating our first app in Autopilot

1. Log into your Twilio Console and go to Autopilot Console

2. Build a new bot named Happy Times Pizza - choosing Start from Scratch

3. Delete all tasks created by AutoPilot by default - Let's start with an empty canvas. 

    From tasks list page find 'fallback','collect_fallback','goodbye', 'greeting','goodbye' tasks   bye selecting Program option next to each task. On following page you will be able to delete task by clicking trash icon. 

4. Create reservation task.

    Go to the Tasks folder and find the reservations file.  Open and paste JSON content on Program page. Navigate to Train page and add sample from file

5. Create goodbye task.

    Find goodbye file in Tasks folder.  Open and paste JSON content on Program page.

6. Navigate to Default Behaviors

   Set Assistant Initiation to point to reservation task
   set Fallback and On Failure behavior to goodbye task

7. Build model

8. Test in simulator

   Find link to Simulator left hand menu. Text 'happy' in messenger pane and follow prompts.  Switch to voice pane and Make A Call .. follow prompts.
   

    SUCCESS! You are done with Step 1!


### Step 2 - Add Additional Tasks (go to tasks folder in resources)

We completed our abbreviated app and tested it successfully.  Now lets add all the additional tasks we need for our full app experience. 

1.  Create anything-else task

    Go to the Tasks folder and find the anything-else file.  Open and paste JSON content on Program page.

2. Create business-hours task.  

    Go to the Tasks folder and find the business-hours file.  Open and paste JSON content on Program page. Navigate to Train page and add samples from file

4. Create error task
    
    Go to the Tasks folder and find the error file.  Open and paste JSON content on Program page. 

5. Create greeting task. 

    Go to the Tasks folder and find the greeting file.  Open and paste JSON content on Program page. Navigate to Train page and add sample from  file

6. Create location task. 

 Go to the Tasks folder and find the location file.  Open and paste JSON content on Program page. Navigate to Train page and add samples from  file


7. Open reservation task.

    Go to the Tasks folder and find the reservation_replace file.  Open and paste JSON content on Program page replacing what's there. Navigate to Train page and remove 'happy' sample.  Copy samples from reservation_replace file and add to task

8. Create review task. Add samples

    Go to the Tasks folder and find the review file.  Open and paste JSON content on Program page. Navigate to Train page and add samples from  file

9. Build a new model


10. Lets test our assistant with the simulator (both text and voice)

    SUCCESS! You completed Step 2! 

### Step 3 - Set up SMS and Voice Channel

1. Go to Autopilot->Channels 

    Select Programmable Voice and copy URL to notes.txt in resources folder. Then do the same for SMS and Chat

2. Go to Phone Numbers in Twilio Console

    Either select and existing number or purchase and new one.

    Copy AutoPilot Channel Voice Url from notes.txt to A Call Comes In  field. Select Webhook from drop down. 
    
    Copy AutoPilot Channel Messaging Url for notes.txt to A Message Comes In field. Select Webhook from drop down.

    Save changes.

3. Test 

    Text 'happy' to the number you set up. 
    Now call it.

    SUCCESS! You completed Step 3 

### Step 4 - Setup Chat Channel

In this step we are going to setup our Chat channel that will be available from our web site. We will also be using our first sdk that you will find in sdks chat.

1. Set up Chat Service

    In Twilio Console go to Programmable Chat

    Create new chat service called Happy_Times_Chat

    Copy the SERVICE SID to the notes file for later use

    Select Webhooks in from Programmable Chat menu

    Copy AutoPilot Channel Messaging Url from notes.txt to Callback Url field under second block of settings - Post-Event Webhooks.

    Check every callback event

2. Create Api Keys for Chat Service

    Under Programmable Chat go to Tools/ Api Keys

    Create new key pair called Happy_Times_Keys

    Copy to TWILIO_API_KEY and TWILIO_API_SECRET in notes file

3. Set Up Chat SDK

    Go to chat-sdk folder and choose your preferred language. Detailed instructions can be found on https://github.com/twyzle/multi-channel-apps/tree/master/chat-sdk. Select link to preferred language. ReadMe.md file contains detailed info

    Copy .env.example to .env

    Go to notes file and copy chat variables  .env file

    run web server 

    go to localhost:3000 in browser

    Type 'happy' follow prompts

    SUCCESS!  We have successfully set up chat


### Step 5 - Setup Twilio Client

Now we are going to set up Twilio Client for click to call within browser. 

1. Create TWIML App

    Go to Twilio Console and find Programmable Voice / Twiml / Twiml Apps

    Create a new app and call it Happy_Times_Twiml

    Copy sid to notes file. You don't need to add anythng to voice and messaging fields

2. Create Helper functions

    Go to Twilio Runtime | Functions 

    Create new function selecting Client Quickstart template

    Enter Twiml app sid and Twilio number using for voice assistant in CALLER ID field.

    Click on Twilio Client Quickstart (Capability token) function and copy url in path field

3. Copy cabability token to Quickstart SDK

    Goto client-quickstart-js-master / public and open quickstart.js

    Copy capability token url from path to line 11

    Run web server on localhost:3000

    Enter Twilio Number for voice assistant in phone number field

    Click make call

    SUCCESS! we are done with step 5

### Step 6 - Pulling it all together with happytimespizza.com
    
    Go back to the chat sdk folder you use to set up Chat Channel

1. Switch index files
        
        Rename index.html to index-old.html

        Rename index.chat to index.html

2. Open index.html and replace TWILIO_NUMBER with actual number on line 64

3. Copy quickstart.js from client-quickstart-js-master/public/quickstart.js to  web-app/js/client (eg. sdk-starter-php-master/webroot/web-app/js/client/)

4. run web server on locahost:3000

5. now go to happytimepizza.com and find 'Try Your Happy Times Assistant on Your Local Machine'. Click on the button below

    SUCCESS! You did it! 

### Step 7 - Using Twilio Studio with Autopilot for post conversation follow up

    Now we are ready for our final task. We want to send any customers that reviewed us with 2 or less stars and offer them a free meal on their next visit.  We are going to use Twilio Studio as a wrapper for our assistant experience and link it to voice and messages in our Twilio number settings.

1. Extract the assistant sid from your twilio voice channel url.  
    
    In the example below UA66da5765fcb17cd9c3062d0212b7af05 is the assistant id 
    https://channels.autopilot.twilio.com/v1/ACXXXXXXXXXXXXXXXXXXX/UA66da5765fcb17cd9c3062d0212b7af05/twilio-voice
    
    Open happy-times.json from your resources folder and find "autopilot_assistant_sid". Add your acutal asssitant id to the file and save.

2. Create new Studio Flow

    Name flow happy_times_flow

    Select import from JSON

    Copy json from happy-times.json file and paste into text-area

3. Setup Twilio Number to point to Studio Flow

    Go to Twilio Phone Number and select phone number

    Go to A Call Comes In and switch from Webhook to Studio. Select flow from dropdown.

    Go to A Message Comes In and switch from Webhook to Studio.   Select flow from dropdown.

    Now test out your flow by texting number. Now call it.

YOU MADE IT! WELL DONE!


        