if (document.getElementById("signup") !== null) {
  const url = new URL(window.location.toLocaleString());
  let current_error = url.searchParams.get("error");

  form = document.getElementById("form-itself");

  username_inp = document.querySelector("[name=username]");
  email_inp = document.querySelector("[name=email]");
  password_inp = document.querySelector("[name=password]");
  confirm_password_inp = document.querySelector("[name=confirm_password]");

  username_label = document.getElementById("name");
  email_label = document.getElementById("email");
  password_label = document.getElementById("password");
  confirm_password_label = document.getElementById("confirm_password");

  if (current_error == "user-taken") {
    username_inp.className = "failed";
    username_label.className = "user-taken";
  }
  if (current_error == "email-taken") {
    email_inp.className = "failed";
    email_label.className = "email-taken";
  }

  form.addEventListener("submit", (event) => {
    username_inp.className = "";
    email_inp.className = "";
    password_inp.className = "";
    confirm_password_inp.className = "";

    username_label.className = "";
    email_label.className = "";
    password_label.className = "";
    confirm_password_label.className = "";

    let error = false;
    let valid_email = /\S+@\S+\.\S+/;

    if (password_inp.value !== confirm_password_inp.value) {
      password_inp.className = "failed";
      password_label.className = "passwords-no-match";
      confirm_password_inp.className = "failed";
      confirm_password_label.className = "passwords-no-match";
      error = true;
    }
    if (valid_email.test(email_inp.value) === false) {
      email_inp.className = "failed";
      email_label.className = "invalid-email";
      error = true;
    }
    if (username_inp.value === "" || username_inp == null) {
      username_inp.className = "failed";
      username_label.className = "empty-field";
      error = true;
    }
    if (email_inp.value === "" || email_inp == null) {
      email_inp.className = "failed";
      email_label.className = "empty-field";
      error = true;
    }
    if (password_inp.value === "" || password_inp == null) {
      password_inp.className = "failed";
      password_label.className = "empty-field";
      error = true;
    }
    if (confirm_password_inp.value === "" || confirm_password_inp == null) {
      confirm_password_inp.className = "failed";
      confirm_password_label.className = "empty-field";
      error = true;
    }
    if (error === true) {
      event.preventDefault();
    }
  });
}

if (document.getElementById("login") !== null) {
  form = document.getElementById("form-itself");

  email_inp = document.querySelector("[name=email]");
  email_label = document.getElementById("email");

  password_inp = document.querySelector("[name=password]");
  password_label = document.getElementById("password");

  const url = new URL(window.location.toLocaleString());
  let current_error = url.searchParams.get("error");
  if (current_error == "wrong-password") {
    password_inp.className = "failed";
    password_label.className = "wrong-password";
  }
  if (current_error == "wrong-email") {
    email_inp.className = "failed";
    email_label.className = "wrong-email";
  }

  form.addEventListener("submit", (event) => {
    let error = false;
    email_inp.className = "";
    password_inp.className = "";

    email_label.className = "";
    password_label.className = "";

    if (email_inp.value === "" || email_inp == null) {
      email_inp.className = "failed";
      email_label.className = "empty-field";
      error = true;
    }
    if (password_inp.value === "" || password_inp == null) {
      password_inp.className = "failed";
      password_label.className = "empty-field";
      error = true;
    }
    if (error === true) {
      event.preventDefault();
    }
  });
}
