<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title> <!--Change the text to "Register"-->
    <style>
        form{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.container{
    display: flex;
    flex-direction: column;
    width: 25vw;
}
h1, p{
    text-align: center;
}
/* font family is added */
body {
  font-family: Arial, Helvetica, sans-serif;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.container {
    display: flex;
    flex-direction: column;
    width: 40%;
    border: 40px solid #000;
    padding: 12px;
}

h1, p {
  text-align: center;
}

/* desired spacing for input fields */
input {
  margin: 0.25em 0em 1em 0em;
}
/* more styles added to beautify the input fields */
input {
    margin: 0.25em 0em 1em 0em;
    outline: none;
    padding: 1.5em;
    border: none;
    background-color: rgb(225, 225, 225);
    border-radius: 0.25em;
    color: black;
}
/* styles for button */
button {
  padding: 0.75em;
  border: none;
  outline: none;
  background-color: rgb(68, 18, 232);
  color: white;
  border-radius: 0.25em;
}

/* hover functionality for button */
button:hover {
  cursor: pointer;
  background-color: rgb(41, 4, 164);
}

    </style>
  </head>
  <body>
  <form action="{{route('rejisteruser')}}" method="post">
    @csrf
      <!-- class named "container" is assigned to div -->
      <div class="container">
        <h1>Register</h1>
        <p>Kindly fill in this form to register.</p>
        <label for="username"><b>Username</b></label>
        <input
          type="text"
          placeholder="Enter username"
          name="name"
          id="username"
          
        />

        <label for="email"><b>Email</b></label>
        <input
          type="text"
          placeholder="Enter Email"
          name="email"
          id="email"
          
        />

        <label for="pwd"><b>Password</b></label>
        <input
          type="password"
          placeholder="Enter Password"
          name="password"
          id="pwd"
        />

        <label for="pwd-repeat"><b>Repeat Password</b></label>
        <input
           type="password" 
          placeholder="Repeat Password"
          name="password"
          id="pwd-repeat"
          
        />

        <button type="submit">Register</button>
        <div>
        <p>Already have an account? <a href="{{route('login')}}">Log in</a>.</p>
      </div>
      </div>

      
    </form>


  </body>
</html>
