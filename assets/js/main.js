AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
 

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 700, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});



let nextBtn = document.querySelector('.next');
let prevBtn = document.querySelector('.prev');

let slider = document.querySelector('.slider');
let sliderList = slider.querySelector('.slider .list');
let thumbnail = document.querySelector('.slider .thumbnail');
let thumbnailItems = thumbnail.querySelectorAll('.item');

// Remove the redundant append operation for the first thumbnail item
// thumbnail.appendChild(thumbnailItems[0]);

// Function for next button
nextBtn.onclick = function() {
    moveSlider('next');
    resetAutoSlide();
};

// Function for prev button
prevBtn.onclick = function() {
    moveSlider('prev');
    resetAutoSlide();
};

// Function to move the slider
function moveSlider(direction) {
    let sliderItems = sliderList.querySelectorAll('.item');
    let thumbnailItems = thumbnail.querySelectorAll('.item');

    console.log('Direction:', direction);  // Debugging
    console.log('Slider Items before move:', sliderItems);
    console.log('Thumbnail Items before move:', thumbnailItems);

    if (direction === 'next') {
        sliderList.appendChild(sliderItems[0]); // Move first item to the end
        thumbnail.appendChild(thumbnailItems[0]); // Sync thumbnail
        slider.classList.add('next');
    } else {
        sliderList.prepend(sliderItems[sliderItems.length - 1]); // Move last item to the front
        thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1]); // Sync thumbnail
        slider.classList.add('prev');
    }

    // Handle animation end
    slider.addEventListener('animationend', function() {
        console.log('Animation ended');  // Debugging
        slider.classList.remove(direction === 'next' ? 'next' : 'prev');
    }, { once: true });
}

// Function to automatically move to the next slide after a set interval
let autoSlide = setInterval(function() {
    moveSlider('next');
}, 3000); // Change slides every 3 seconds

// Function to reset the automatic slide timer when user interacts
function resetAutoSlide() {
    clearInterval(autoSlide); // Stop the current interval
    autoSlide = setInterval(function() {
        moveSlider('next');
    }, 3000); // Restart the interval for auto slide
}


/*let previewContainer = document.querySelector('.card-preview');
let previewBox = previewContainer.querySelectorAll('.preview');

document.querySelectorAll('card-boxs.card').forEach(card =>{
    card.onclick = () =>{
        previewContainer.style.display = 'flex';
        let name = card.getAttribute('data-name');
        previewBox.forEach(preview =>{
            let target = preview.getAttribute('data-target');
            if(name == target ){
                preview.classList.add('active');
            }


        });

    };
});


previewBox.forEach(close =>{
    close.querySelector('.ri-close-fill').onclick = () =>{
        close.classList.remove('active');
        previewContainer.style.display = 'none';


    };
}); */

  



/* contuct us page
const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
    e.preventDefault(); // Fix: call preventDefault correctly

    // do nothing if form is not validated
    if (!validateForm(form)) return;
});

const validateForm = (form) => {
    let valid = true;

    // check for empty fields
    let name = form.querySelector(".name");
    let message = form.querySelector(".message");
    let email = form.querySelector(".email");

    // Fix: use comparison (== or ===) instead of assignment (=)
    if (name.value === "") {
        giveError(name, "Please enter your name");
        valid = false; // Update valid status if error occurs
    }

    if (message.value === "") {
        giveError(message, "Please enter your message");
        valid = false;
    }

    if (email.value === "") {
        giveError(email, "Please enter your email");
        valid = false;
    }

    return valid;
};

const giveError = (field, message) => {
    let parentElement = field.closest(".inputbox"); // Use closest(".inputbox") to select parent div
    parentElement.classList.add("error"); // Add the error class to the parent element

    let errorElement = parentElement.querySelector(".error-message");
    if (!errorElement) {
        errorElement = document.createElement("span");
        errorElement.classList.add("error-message");
        parentElement.appendChild(errorElement);
    }
    errorElement.textContent = message;
};

*/



/*
function handleContact(event){
    event.preventDefault();
const name = event.target.name.value
   const email = event.target.email.value
   const message = event.target.message.value

  console.log(name);
  console.log(email);
  console.log(message);

 const successContainer = document.getElementById("success_container");
 console.log(successContainer);

 const nameParagraph = document.createElement("p");
 nameParagraph.innerText = `Your name : ${name}`; 

 const emailParagraph = document.createElement("p");
 emailParagraph.innerText = `Your email : ${email}`;

const messageParagraph = document.createElement("p");
messageParagraph.innerText = `Your email : ${message}`;

console.log(nameParagraph);
console.log(emailParagraph);
console.log(messageParagraph);

successContainer.appendChild(nameParagraph);
successContainer.appendChild(emailParagraph);
successContainer.appendChild(messageParagraph);
}*/

/* contact us 

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting
        let isValid = true; // Track if the form is valid

        // Clear all previous error messages
        document.querySelectorAll(".error-message").forEach((el) => (el.textContent = ""));

        // Fetch field values
        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const message = form.message.value.trim();

        // Validate name
        if (name === "") {
            showError(form.name, "Name is required");
            isValid = false;
        }

        // Validate email with regex
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            showError(form.email, "Email is required");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            showError(form.email, "Please enter a valid email address");
            isValid = false;
        }

        // Validate message
        if (message === "") {
            showError(form.message, "Message is required");
            isValid = false;
        }

        // Submit the form if valid
        if (isValid) {
            form.submit(); // Submit to the PHP backend
        }
    });

    function showError(input, message) {
        const errorSpan = input.parentElement.querySelector(".error-message");
        if (errorSpan) {
            errorSpan.textContent = message;
            errorSpan.style.color = "red";
        }
    }
}); /


// Function to show an error message
function showError(input, message) {
    const errorSpan = input.parentElement.querySelector(".error-message");
    if (errorSpan) {
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
    }
}

// Function to clear all error messages
function clearErrors(form) {
    const errorMessages = form.querySelectorAll(".error-message");
    errorMessages.forEach((error) => {
        error.textContent = "";
    });
}


// Function to show an error message
function showError(input, message) {
    const errorSpan = input.parentElement.querySelector(".error-message");
    if (errorSpan) {
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
    }
}

// Function to clear all error messages
function clearErrors(form) {
    const errorMessages = form.querySelectorAll(".error-message");
    errorMessages.forEach((error) => {
        error.textContent = "";
    });
}


function showError(inputField, message) {
    const inputBox = inputField.closest(".inputbox");
    inputBox.classList.add("error");

    // Create error message element if it doesn’t exist
    let errorElement = inputBox.querySelector(".error-message");
    if (!errorElement) {
        errorElement = document.createElement("span");
        errorElement.classList.add("error-message");
        inputBox.appendChild(errorElement);
    }

    // Set error message text
    errorElement.innerText = message;
}

function clearErrors(form) {
    form.querySelectorAll(".error").forEach(inputBox => inputBox.classList.remove("error"));
    form.querySelectorAll(".error-message").forEach(errorMsg => errorMsg.remove());
}*/






