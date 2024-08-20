document.addEventListener("DOMContentLoaded", function () {
  const loginButton = document.getElementById("loginButton");
  if (loginButton) {
    loginButton.addEventListener("click", function () {
      console.log("Login button clicked");
      // เพิ่มโค้ดสำหรับการล็อกอินที่นี่
    });
  } else {
    console.error("Login button not found");
  }
});
