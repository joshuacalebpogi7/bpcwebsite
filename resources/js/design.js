let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

// Define the Design class
// export class Design {
//    constructor() {
//      // Get references to the elements you want to work with
//      this.navbar = document.querySelector('.header .flex .navbar');
//      this.profile = document.querySelector('#menu-btn');
 
//      // Attach a click event handler to the profile/menu button
//      this.profile.onclick = () => {
//        // Toggle the 'active' class on the navbar
//        this.navbar.classList.toggle('active');
//        // Ensure that the 'active' class is removed from other elements if needed
//        // Example: document.querySelector('.other-element').classList.remove('active');
//      };
//    }
 
//    // Add other methods and properties to your Design class as needed
//  }
 