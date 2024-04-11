var login = () => {
    window.location.assign("./login.html");
};

const FirstName = document.getElementById("fristname");
const LastName = document.getElementById("lastname");
const Email = document.getElementById("email");
const MobileNumber = document.getElementById("mobilenumber");
const Password = document.getElementById("password");
const ReEnterPassword = document.getElementById("Repassword");
const message = document.getElementById("message");
var regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\. \-]+\.[a-zA-z0-9]{2,4}$/;


const FullName = document.getElementById("fullname");
const City = document.getElementById("city");
const Enrollment = document.getElementById("enr");
const College = document.getElementById("college");
const Course = document.getElementById("course"); 
const Branch = document.getElementById("branch");
const Sem = document.getElementById("sem");
const Mobile = document.getElementById("mobile");
const Email_1 = document.getElementById("email_1");
const Pass = document.getElementById("pass");




const SignUp = () => {
    if (FirstName.value === "") {
      message.innerHTML = "First Name Required!";
      message.style.color = "red";
    } else if (LastName.value === "") {
      message.innerHTML = "Last Name Required!";
      message.style.color = "red";
    } else if (MobileNumber.value === "") {
      message.innerHTML = "Mobile Number Required!";
      message.style.color = "red";
    } else if (MobileNumber.value.length < 11) {
      message.innerHTML = "Please Enter 11 digit Mobile No.";
      message.style.color = "red";
    } else if (Email.value === "") {
      message.innerHTML = "Email Address Required!";
      message.style.color = "red";
    } else if (!Email.value.match(regex)) {
      message.innerHTML = "Please Enter Correct Email Address";
      message.style.color = "red";
    } else if (Password.value === "") {
      message.innerHTML = "Password Required";
      message.style.color = "red";
    } else if (Password.value.length < 6) {
      message.innerHTML = "Please Enter at least 6 digit Password";
      message.style.color = "red";
    } else if (ReEnterPassword.value === "") {
      message.innerHTML = "Re Enter Password Required";
      message.style.color = "red";
    } else if (ReEnterPassword.value !== Password.value) {
      message.innerHTML = "Password donot match";
      message.style.color = "red";
    }else{
      firebase.auth().createUserWithEmailAndPassword( Email.value, Password.value)
  .then((userCredential) => {
    var d = new Date().toLocaleDateString();
    // database
    var userdata = {
      FirstName: FirstName.value,
      LastName: LastName.value,
      MobileNumber: MobileNumber.value,
      Email: Email.value,
      Password: Password.value,
      ReEnterPassword: ReEnterPassword.value,
      uid: userCredential.user.uid,
      ProfilePicture: "",
      CoverPicture: "",
      Description: "",
      Signupdate: `${d}`,
    };
    firebase.firestore().collection("users").doc(userCredential.user.uid).set(userdata).then((res)=>{
      message.innerHTML ="Account was created successfuly"
      message.style.color ="green"
      const user = firebase.auth().currentUser;
      user.sendEmailVerification().then((res)=>{
          window.location.assign("../pages/emailVerification.html")
      })
    })
    message.innerHTML= "Sign Up Successfully"
  })
  .catch((error) => {
    message.innerHTML = error.message;
    // ..
  });
        
    }
}









const SignUpStud = () => {
  if (FullName.value === "") {
    message.innerHTML = "Full name Required!";
    message.style.color = "red";
  } else if (City.value === "") {
    message.innerHTML = "City name Required!";
    message.style.color = "red";
  } else if (Enrollment.value === "") {
    message.innerHTML = "Enrollment/Roll No. Required!";
    message.style.color = "red";
  }else if (College.value === "") {
    message.innerHTML = "College/School Required!";
    message.style.color = "red";
  }else if (Course.value === "") {
    message.innerHTML = "Course Required";
    message.style.color = "red";
  }else if (Branch.value === "") {
    message.innerHTML = "Branch/Specialization Required!";
    message.style.color = "red";
  }else if (Sem.value === "") {
    message.innerHTML = "Semester/Standard Required!";
    message.style.color = "red";
  }else if (Mobile.value === "") {
    message.innerHTML = "Mobile Number Required!";
    message.style.color = "red";
  }else if (Email_1.value === "") {
    message.innerHTML = "Email Address Required!";
    message.style.color = "red";
  }else if (Pass.value.length < 6) {
    message.innerHTML = "Please Enter at least 6 digit Password";
    message.style.color = "red";
  }else if (Cpass.value !== Pass.value) {
    message.innerHTML = "Password do not match";
    message.style.color = "red";
  }else{
    firebase.auth().createUserWithEmailAndPassword( Email_1.value, Pass.value)
.then((userCredential) => {
  var d1 = new Date().toLocaleDateString();
  // database
  var student_data = {
    FullName: FullName.value,
    City: City.value,
    Enrollment: Enrollment.value,
    College: College.value,
    Course: Course.value,
    Branch: Branch.value,
    Sem: Sem.value,
    Mobile: Mobile.value,
    Email_1: Email_1.value,
    Pass: Pass.value,
    uid: userCredential.user.uid,
    ProfilePicture: "",
    CoverPicture: "",
    Description: "",
    Signupdate: `${d1}`,
  };
  firebase.firestore().collection("users").doc(userCredential.user.uid).set(student_data).then((res)=>{
    message.innerHTML ="Account created successfuly"
    message.style.color ="green"
    const user = firebase.auth().currentUser;
    user.sendEmailVerification().then((res)=>{
      window.location.assign("../pages/emailVerification.html")
    })
  })
  message.innerHTML= "Signed Up Successfully"
})
.catch((error) => {
  message.innerHTML = error.message;
  // ..
});
      
  }
}