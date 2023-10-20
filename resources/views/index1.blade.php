@extends('frontoffice.layouts.user_type.auth')

@section('content')
<style>
  .chat {
  margin-top: 5rem;
  margin-bottom: 3rem;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  box-sizing: border-box;
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  height: var(--bs-card-height);
  word-wrap: break-word;
  background-clip: initial;
  border: 0 !important;
  margin-top: 1.5rem !important;
  background-color: #fff;
  box-shadow: 0 0 3px rgba(60, 72, 88, 0.15) !important;
  border-radius: 6px !important;
  }
  .chat .top {
  display: block;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  word-wrap: break-word;
  box-sizing: border-box;
  border-bottom: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
  justify-content: space-between !important;
  padding: 1.5rem !important;
  }
  .chat .top img {
  display: inline-block;
  border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
  border-radius: 50% !important;
  box-shadow: 0 0 3px rgba(60, 72, 88, 0.15) !important;
  }
  .chat .top div {
  display: inline-block;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  word-wrap: break-word;
  box-sizing: border-box;
  overflow: hidden !important;
  margin-left: 1rem !important;
  }
  .chat .top div p {
  display: block;
  text-align: var(--bs-body-text-align);
  word-wrap: break-word;
  box-sizing: border-box;
  text-decoration: none !important;
  transition: all 0.5s ease;
  padding-top: 1rem;
  font-size: 1rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  margin-bottom: 0 !important;
  color: #3c4858 !important;
  font-family: var(--bs-font-sans-serif);
  line-height: 1.4;
  font-weight: 600;
  }
  .chat .top div small, .chat .top div .small {
  display: block;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  word-wrap: break-word;
  box-sizing: border-box;
  font-size: 0.875em;
  color: #6c757d !important;
  } 
  .chat .messages {
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  word-wrap: break-word;
  box-sizing: border-box;
  list-style: none;
  margin-bottom: 0 !important;
  padding: 1rem !important;
  }
  .chat .messages .left {
  text-align: left;
  }
  .chat .messages .right {
  text-align: right;
  }
  .chat .messages .message {
  margin-bottom: 1rem;
  }
  .chat .messages .message p {
  display: inline-flex;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  word-wrap: break-word;
  list-style: none;
  box-sizing: border-box;
  font-size: 0.875em;
  margin: 0.25rem;
  padding: 0.5rem 1rem !important;
  color: #6c757d !important;
  background-color: rgba(var(--bs-light-rgb), 1) !important;
  border-radius: var(--bs-border-radius) !important;
  }
  .chat .messages .message img {
  display: inline-flex;
  margin: 0.25rem;
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  word-wrap: break-word;
  box-sizing: border-box;
  vertical-align: middle;
  border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
  border-radius: 50% !important;
  box-shadow: 0 0 3px rgba(60, 72, 88, 0.15) !important;
  height: 45px;
  width: 45px;
  }
  .chat .bottom {
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  text-align: var(--bs-body-text-align);
  font-family: "Nunito", sans-serif;
  font-size: 1rem;
  color: #161c2d;
  word-wrap: break-word;
  box-sizing: border-box;
  padding: 1rem 0 !important;
  border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
  }
  .chat .bottom input {
  float: left;
  display: inline-flex;
  word-wrap: break-word;
  box-sizing: border-box;
  width: 75%;
  padding: 0.375rem 0.75rem;
  font-weight: 400;
  background-color: #fff;
  background-clip: padding-box;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  border: 1px solid #e9ecef;
  font-size: 14px;
  line-height: 26px;
  border-radius: 6px;
  color: #3c4858 !important;
  }
  .chat .bottom button {
  float: right;
  display: inline-flex;
  text-align: center;
  cursor: pointer;
  border: 1px solid #484848;
  border-radius: 5px;
  margin: 3px;
  width: 2.35rem;
  height: 2.35rem;
  background: url("https://assets.edlin.app/icons/font-awesome/paper-plane/paper-plane-regular.svg") center no-repeat;
  }
</style>






<section class="banner-area relative" >	
  <div class="overlay overlay-bg"></div>
  <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
          <div class="about-content col-lg-12">
                  <h1 class="text-white">
                      Chat :				
                  </h1>	
                  <p class="text-white link-nav"><a>Home</a>  <span class="lnr lnr-arrow-right"></span>  <a> Chat</a></p>
          </div>											
      </div>
  </div>
</section>
<section>
  <div class="container col-md-12">
      <div class="row d-flex justify-content-center">
          <div class="menu-content pb-60 col-lg-10">
              <div class="title text-center">
                  <h1 class="mb-10">Chat :</h1>
              </div>
          </div>
      </div>
      <div class="container">

          <div class="chat" >
            <div class="top" >
              <p>{{ $user->name }}</p>
              <small class="{{ $user->isOnline ? 'online' : 'offline' }}">{{ $user->isOnline ? 'online' : 'offline' }}</small>
            </div>
            <div class="messages">
                <div class="messages-text"> 
                  @include('receive', ['message'=> "hey! what's up! "])
                </div>
            </div>
        
          <div class="bottom">
              <form>
                  <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                  <button type="submit"></button>
              </form>
          </div>
        </div>
        
        <script>
        const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
        const channel = pusher.subscribe('public');
        
        // Receive messages
        channel.bind('chat', function (data) {
          $.post("/receive", {
            _token: '{{csrf_token()}}',
            message: data.message,
          }).done(function (res) {
            // Append the received message to the messages container
            $(".messages").append(res);
        
            // Scroll to the bottom of the chat container
            const chatContainer = $(".messages");
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
          });
        });
        
        // Broadcast messages
        $("form").submit(function (event) {
          event.preventDefault();
          
          // Get the message from the input field
          const message = $("form #message").val();
          
          // Display the sent message in the chat interface
          $(".messages").append('<div class="message"><div class="message-text">' + message + '</div></div>');
          
          // Scroll to the bottom of the chat container
          const chatContainer = $(".messages");
          chatContainer.scrollTop(chatContainer[0].scrollHeight);
        
          $.ajax({
            url: "/broadcast",
            method: 'POST',
            headers: {
              'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
              _token: '{{csrf_token()}}',
              message: message,
            }
          }).done(function (res) {
            $("form #message").val('');
          });
        });
        </script>
      </div>
  </div>


</section>
@endsection