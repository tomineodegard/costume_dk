// "use strict";
// // wait until DOM is ready
// document.addEventListener("DOMContentLoaded", function(event) {
  
//     console.log("DOM loaded");
    
//     // wait until images, links, fonts, stylesheets, and js is loaded
//     window.addEventListener("load", function(e) {
      
//       // custom GSAP code goes here
//        console.log("window loaded");
      
//     }, false);
    
//   });

// gsap.registerPlugin(ScrollTrigger);

// ScrollTrigger.defaults({
//   markers: false
// });

// // Logo animation
// let triggerElement = document.querySelector(".elementor-11 .elementor-element.elementor-element-f29e20e > .elementor-container");
// let targetElement = document.querySelector("#scrollTriggeredLogo");
  
// let myTimeline = gsap.timeline({
//     scrollTrigger: {
//     trigger: triggerElement,
//     start: "top center",
//     end: "bottom top",
//     scrub: 1,
//     pin: true
//     }
//  });

// myTimeline.to(targetElement, {
//     width: "20%",
//     y: "-90%",
//     duration: 1,
//     toggleActions: "restart pause reverse pause",
//     scale: 0.5,
// });




