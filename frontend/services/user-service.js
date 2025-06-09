var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.replace("index.html");
    }
   $("#loginForm").validate({
      rules: {
     			name: 'required',
     			email: {
      			required: true,
       		email: true
     		},
     		password: {
       		required: true,
       		minlength: 6,
     		}
   	},
   	messages: {
     		name: 'Please enter your name',
     		email: {
       	required: 'Please enter your email',
       	email: 'Please enter a valid email address'
     	},
     	password: {
       	required: 'Please enter a password',
       	minlength: 'Password must be at least 6 characters long',
     	}
   },
   submitHandler: function (form) {
     let user = Object.fromEntries(new FormData(form).entries());
     UserService.login(user);
   },
 });
},
login: function (entity) {
   $.ajax({
     url: Constants.PROJECT_BASE_URL + "auth/login",
     type: "POST",
     data: JSON.stringify(entity),
     contentType: "application/json",
     dataType: "json",
     success: function (response) {
    localStorage.setItem("user_token", response.token);
   localStorage.setItem("userRole", response.user.role);
  localStorage.setItem("userId", response.user.id);
  alert("Login successful!");
  window.location.href = "index.html";
},
     error: function (XMLHttpRequest, textStatus, errorThrown) {
       toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
        $("#error").show().text("Invalid credentials");
     },
   });
 },

   logout: function () {
    localStorage.clear();
    window.location.replace("login.html");
  },
 generateMenuItems: function(){
   const token = localStorage.getItem("user_token");
   const user = Utils.parseJwt(token).user;
   if (user && user.role){
     let nav = "";
     let main = "";
     switch(user.role) {
       case Constants.USER_ROLE:
         nav = '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded " href="#users">Users</a>'+
             '</li>'+
             '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#highcharts">Highcharts</a>'+
             '</li>'+
             '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#forms">Forms</a>'+
             '</li>'+
             '<li>'+
                 '<button class="btn btn-primary" onclick="UserService.logout()">Logout</button>'
             '</li>';
             $("#tabs").html(nav);
         main =
             '<section id="highcharts"></section>'+
             '<section id="forms"></section>'+
             '<section id="view_more"></section>'+
             '<section id="users" data-load="users.html"></section>';
             $("#spapp").html(main);
         break;
       case Constants.ADMIN_ROLE:
         nav = '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded " href="#users">Users</a>'+
             '</li>'+
             '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#highcharts">Highcharts</a>'+
             '</li>'+
             '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#forms">Forms</a>'+
             '</li>'+
             '<li class="nav-item mx-0 mx-lg-1">'+
                 '<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#forms">FormsADMIN</a>'+
             '</li>'+
             '<li>'+
                 '<button class="btn btn-primary" onclick="UserService.logout()">Logout</button>'
             '</li>';
             $("#tabs").html(nav);
         main =
             '<section id="highcharts"></section>'+
             '<section id="forms"></section>'+
             '<section id="view_more"></section>'+
             '<section id="users" data-load="users.html"></section>';
             $("#spapp").html(main);
         break;
       default:
         $("#tabs").html(nav);
         $("#spapp").html(main);
     }
   } else {
       window.location.replace("login.html");
   }
 }
};