//search icon toggle

document.addEventListener("DOMContentLoaded", function () {
  const searchWeb = document.querySelector("#searchWeb");

  const subSearch = document.querySelector("#subSearch");

  if (searchWeb) {
    searchWeb.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent the default scroll to top behavior

      searchWeb.classList.toggle("active");

      if (subSearch) {
        subSearch.classList.toggle("active");
      }
    });
  }
});

//search icon toggle - mobile

// document.addEventListener('DOMContentLoaded', function () {

//   const searchMobile = document.querySelector('#searchMobile');

//   const subSearch = document.querySelector('#subSearch');

//   if (searchMobile) {

//     searchMobile.addEventListener('click', function (event) {

//       event.preventDefault(); // Prevent the default scroll to top behavior

//       searchMobile.classList.toggle('active');

//       if (subSearch) {

//         subSearch.classList.toggle('active');

//       }

//     });

//   }

// });

document.addEventListener("DOMContentLoaded", function () {
  const searchMobile = document.querySelector("#searchMobile");

  const subSearch = document.querySelector("#subSearch");

  // 👇 add these

  const subMobile = document.querySelector("#subMobile");

  const subMobileMenu = document.querySelector("#subMobileMenu");

  function isMobile() {
    return window.innerWidth <= 1199;
  }

  if (searchMobile) {
    searchMobile.addEventListener("click", function (event) {
      event.preventDefault();

      if (!isMobile()) return;

      searchMobile.classList.toggle("active");

      if (subSearch) {
        subSearch.classList.toggle("active");
      }

      if (subMobile) subMobile.classList.remove("active");

      if (subMobileMenu) subMobileMenu.classList.remove("active");
    });
  }
});

// mobile sub menu toggle - mobile

// document.addEventListener('DOMContentLoaded', function () {

//   const searchMobile = document.querySelector('#subMobile');

//   const subMobileMenu = document.querySelector('#subMobileMenu');

//   if (searchMobile) {

//     searchMobile.addEventListener('click', function (event) {

//       event.preventDefault(); // Prevent scroll to top

//       searchMobile.classList.toggle('active');

//       if (subMobileMenu) {

//         subMobileMenu.classList.toggle('active');

//       }

//     });

//   }

// });

document.addEventListener("DOMContentLoaded", function () {
  const searchMobile = document.querySelector("#subMobile");

  const subMobileMenu = document.querySelector("#subMobileMenu");

  const subSearch = document.querySelector("#subSearch");

  function isMobile() {
    return window.innerWidth <= 1199;
  }

  if (searchMobile) {
    searchMobile.addEventListener("click", function (event) {
      event.preventDefault();

      if (!isMobile()) return;

      searchMobile.classList.toggle("active");

      if (subMobileMenu) {
        subMobileMenu.classList.toggle("active");
      }

      // 👇 remove active from search when mobile menu is used

      if (subSearch) {
        subSearch.classList.remove("active");
      }
    });
  }
});

//search-submenu toggle

document.addEventListener("DOMContentLoaded", function () {
  const searchMobile = document.querySelector("#searchMobile");

  const subMobile = document.querySelector("#subMobile");

  if (!searchMobile || !subMobile) return;

  // Watch for class changes on subMobile

  const observer = new MutationObserver(function () {
    const isMobileActive = subMobile.classList.contains("active");

    if (isMobileActive) {
      searchMobile.classList.remove("active");
    }
  });

  observer.observe(subMobile, {
    attributes: true,

    attributeFilter: ["class"],
  });
});

//nav search kicker

document.addEventListener("DOMContentLoaded", function () {
  const inputField = document.querySelector("#subSearch input"); // Select the input field inside subSearch

  const searchKicker = document.querySelector("#subSearch .search-kicker"); // Select p.search-kicker inside subSearch

  if (inputField && searchKicker) {
    inputField.addEventListener("focus", function () {
      // Add .active class to p.search-kicker when input is focused

      searchKicker.classList.add("active");
    });

    inputField.addEventListener("blur", function () {
      // Remove .active class from p.search-kicker when input loses focus

      searchKicker.classList.remove("active");
    });
  }
});

//homepage carousel

// jQuery(document).ready(function ($) {
//   var $carousel = $(".video-carousel");

//   var flickityInstance = $carousel.flickity({
//     cellAlign: "left",

//     contain: true,

//     prevNextButtons: true,

//     pageDots: false,

//     draggable: false,
//   });

//   setTimeout(function () {
//     var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

//     var $nextButton = $carousel.find(".flickity-prev-next-button.next");

//     $(".carousel-navigation .carousel-buttons")
//       .append($prevButton)
//       .append($nextButton);
//   }, 100);

//   var totalSlides = $carousel.flickity("getCellElements").length;

//   // Function to format numbers with leading zero if < 10

//   function formatNumber(n) {
//     return n < 10 ? "0" + n : n;
//   }

//   // Initial status

//   $(".carousel-status").text(
//     formatNumber(1) + " / " + formatNumber(totalSlides),
//   );

//   // Update on slide change

//   $carousel.on("change.flickity", function (event, index) {
//     $(".carousel-status").text(
//       formatNumber(index + 1) + " / " + formatNumber(totalSlides),
//     );
//   });
// });

jQuery(document).ready(function ($) {
  // Do not run on single News Updates pages
  if ($("body").hasClass("single-news-updates")) return;

  var $carousel = $(".video-carousel");

  $carousel.flickity({
    cellAlign: "left",
    contain: true,
    prevNextButtons: true,
    pageDots: false,
    draggable: false,
  });

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $(".carousel-navigation .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  var totalSlides = $carousel.flickity("getCellElements").length;

  function formatNumber(n) {
    return n < 10 ? "0" + n : n;
  }

  $(".carousel-status").text(
    formatNumber(1) + " / " + formatNumber(totalSlides)
  );

  $carousel.on("change.flickity", function (event, index) {
    $(".carousel-status").text(
      formatNumber(index + 1) + " / " + formatNumber(totalSlides)
    );
  });
});


jQuery(document).ready(function ($) {
  $("#homepageCarousel .carousel-thumbnail").on("click", function () {
    var youtubeUrl = $(this).data("youtube-url");

    youtubeUrl = youtubeUrl.replace(
      "https://www.youtube.com/watch?v=",

      "https://www.youtube.com/embed/",
    );

    var iframe =
      '<iframe src="' +
      youtubeUrl +
      '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

    $("#video-container").html(iframe);

    // 👇 add active

    $("#video-modal")
      .addClass("active")

      .fadeIn();
  });

  $(".close-btn").on("click", function () {
    $("#video-modal")
      .removeClass("active")

      .fadeOut();

    $("#video-container").html("");
  });

  $(window).on("click", function (event) {
    if ($(event.target).is("#video-modal")) {
      $("#video-modal")
        .removeClass("active")

        .fadeOut();

      $("#video-container").html("");
    }
  });
});

(function () {
  function replaceArrows() {
    const prev = document.querySelector(".flickity-prev-next-button.previous");

    const next = document.querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `

    <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">

      <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z"

      fill="currentColor" fill-opacity="1.0"/>

    </svg>

    `;

    next.innerHTML = `

    <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">

      <g transform="translate(41, 0) scale(-1, 1)">

        <path transform="translate(0, -0.4)" d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z"

        fill="currentColor" fill-opacity="1.0"/>

      </g>

    </svg>

    `;

    return true;
  }

  // keep trying until Flickity injects buttons

  const interval = setInterval(() => {
    if (replaceArrows()) {
      clearInterval(interval);
    }
  }, 50);
})();

//maps pin change content

jQuery(document).ready(function ($) {
  // The JSON data (same as before)

  const properties = [
    {
      id: "shangResidencesAtWackWack",

      title: "Shang Residences at Wack Wack",

      slug: "https://shangproperties.com/residentials/shang-residences-at-wack-wack/",

      excerpts:
        "At Shang Residences at Wack Wack, we bring the resort to you with beautifully designed spaces dedicated to your health and well-being.",

      type: "Residential",
    },

    {
      id: "oneShangriLaPlace",

      title: "One Shangri-La Place",

      slug: "https://shangproperties.com/residentials/one-shangri-la-place/",

      excerpts:
        "Upgrade the way you live at One Shangri-La Place with a 64-storey twin tower condominium, offering you premium amenities and access to Shangri-La Plaza mall that serve as the benchmark for luxury residential developments in the Philippines.",

      type: "Residential",
    },

    {
      id: "shangriLaPlaza",

      title: "Shangri-La Plaza",

      slug: "https://shangproperties.com/malls/shangri-la-plaza/",

      excerpts:
        "Shangri-La Plaza is, undisputedly, the country’s most established upscale shopping and lifestyle destination. It offers its customers a complete and carefully selected mix of superior goods and services in well-planned merchandise zones.",

      type: "Malls",
    },

    {
      id: "shangCentral",

      title: "Shang Central",

      slug: "https://shangproperties.com/residentials/shang-central/",

      excerpts:
        "At Shang Central, we’ve brought together everything you love about Shangri-La to create a beautiful integrated living experience for you in the heart of the city.",

      type: "Residential",
    },

    {
      id: "theStFrancisShangriLaPlace",

      title: "The St. Francis Shangri-La Place",

      slug: "https://shangproperties.com/residentials/the-st-francis-shang-la-place/",

      excerpts:
        "Discover the allure of St. Francis Shangri-La Place, the twin-tower residential condominium skyscrapers in the city of Mandaluyong, and one of the tallest residential buildings in the country.",

      type: "Residential",
    },

    {
      id: "theRiseMakati",

      title: "The Rise Makati",

      slug: "https://shangproperties.com/residentials/the-rise-makati/",

      excerpts:
        "At 59 storeys high, The Rise will offer innovative lifestyle choices in a dynamic neighborhood teeming with galleries, delicatessens and bistros, indie music venues and unique retail destinations.",

      type: "Residential",
    },

    {
      id: "shangSalcedoPlace",

      title: "Shang Salcedo Place",

      slug: "https://shangproperties.com/residentials/shang-salcedo-place/",

      excerpts:
        "An unexpected blend of classic sophistication and modern vision, Shang Salcedo, a 67-storey luxury development, features 749 units ranging from one, two, three-bedrooms, and penthouse units that will elevate the standards of luxury living in Salcedo Village.",

      type: "Residential",
    },

    {
      id: "assemblyGrounds",

      title: "Assembly Grounds",

      slug: "https://shangproperties.com/malls/assembly-grounds/",

      excerpts:
        "Assembly Grounds at The Rise is the perfect place to meet up with family and friends for chill and catch up sessions at any time of the day.",

      type: "Malls",
    },

    {
      id: "theEnterpriseCenter",

      title: "The Enterprise Center",

      slug: "https://shangproperties.com/offices/the-enterprise-center/",

      excerpts:
        "The Enterprise Center offers office space designed for companies and entrepreneurs of any size or stage. It is home to the top names in Philippine business both multinational and local companies.",

      type: "Offices",
    },

    {
      id: "theShangGrandTower",

      title: "The Shang Grand Tower",

      slug: "https://shangproperties.com/residentials/the-shang-grand-tower/",

      excerpts:
        "This 46-storey gem never fails to amaze onlookers with its traditional art deco-design built for your family’s discriminating taste.",

      type: "Residential",
    },

    {
      id: "horizonHomes",

      title: "Horizon Homes",

      slug: "https://shangproperties.com/residentials/horizon-homes/",

      excerpts:
        "Welcome to Horizon Homes, a rare collection of 98 exquisite, luxury dwellings by Shangri-La located at the pinnacle of the new Shangri-La at the Fort complex in Bonifacio Global City.",

      type: "Residential",
    },

    {
      id: "aureliaResidences",

      title: "Aurelia Residences",

      slug: "https://shangproperties.com/residentials/aurelia-residences/",

      excerpts:
        "A limited collection of 285 bespoke residences in a location with cosmopolitan skyline views and lush greens of Manila Golf Club, Manila Polo Club, & Forbes Park.",

      type: "Residential",
    },

    {
      id: "shangSummit",

      title: "Shang Summit",

      slug: "https://shangproperties.com/residentials/shang-summit/",

      excerpts:
        "Shang Summit is reaching new, record-setting heights with its dual iconic towers. It offers breathtaking panoramic city views, redefining luxury living in Quezon City.",

      type: "Residential",
    },

    {
      id: "shangBauhiniaResidences",

      title: "Shang Bauhinia Residences",

      slug: "https://shangproperties.com/residentials/shang-bauhinia-residences/",

      excerpts:
        "Shang Bauhinia Residences ushers in a new era of luxury living, setting an unparalleled standard of sophistication and exclusivity in Cebu.",

      type: "Residential",
    },
  ];

  let lastHoveredPin = "shangResidencesAtWackWack"; // Default to the first pin (shangResidencesAtWackWack)

  // When hovering over a pin

  $(".property-pin").hover(function () {
    const pinId = $(this).attr("id").replace("Pin", ""); // Get ID without 'Pin'

    // Check if the hovered pin is different from the last one

    if (pinId !== lastHoveredPin) {
      // Find the property data matching the hovered pin ID

      const property = properties.find((p) => p.id === pinId);

      if (property) {
        // Update the content only in the targeted section

        $("#shangMaps .title-kicker").text(property.type); // Replace type

        $("#shangMaps h3").text(property.title); // Replace title

        $("#shangMaps p").text(property.excerpts); // Replace excerpts

        $("#shangMaps .arrow-link").attr("href", property.slug); // Replace link with the slug

        // Add 'active' class to the current pin and remove from the last hovered pin

        $(".property-pin").removeClass("active");

        $(this).addClass("active");

        // Update the lastHoveredPin to the current one

        lastHoveredPin = pinId;
      }
    }
  });

  // Reset content on page load (optional, if you want default content after refresh)

  const initialProperty = properties.find((p) => p.id === lastHoveredPin);

  if (initialProperty) {
    $("#shangMaps .title-kicker").text(initialProperty.type); // Replace type

    $("#shangMaps h3").text(initialProperty.title); // Replace title

    $("#shangMaps p").text(initialProperty.excerpts); // Replace excerpts

    $("#shangMaps .arrow-link").attr("href", initialProperty.slug); // Replace link with the slug

    // Make the initial pin active

    $("#shangResidencesAtWackWackPin").addClass("active");
  }
});

//relocate map at 1199px

jQuery(document).ready(function ($) {
  // The element we need to move around

  const h2Element = $("section.homepage-maps .text-content h2");

  const targetContainer = $("section.homepage-maps .homepage-maps-contents"); // Where it goes on small screens

  const originalParent = $("section.homepage-maps .text-content"); // Where it originally resides

  // Function to move the element based on screen width

  const moveElement = () => {
    // Check if the window width is less than or equal to 1199px

    if ($(window).width() <= 1199) {
      // If it's not already in the right place, move it to homepage-maps-contents

      if (
        h2Element.length &&
        targetContainer.length &&
        h2Element.parent()[0] !== targetContainer[0]
      ) {
        targetContainer.append(h2Element); // Move h2 to target container
      }
    } else {
      // If above 1199px, make sure h2 goes back to its original parent

      if (
        h2Element.length &&
        originalParent.length &&
        h2Element.parent()[0] !== originalParent[0]
      ) {
        originalParent.append(h2Element); // Return h2 to its original place
      }
    }
  };

  // Invoke the moveElement function initially when the page loads

  moveElement();

  // Invoke the moveElement function whenever the window is resized

  $(window).resize(function () {
    moveElement();
  });
});

//remove blank p

document.querySelectorAll("p").forEach(function (p) {
  if (p.innerHTML.trim() === "" || p.innerHTML.trim() === "&nbsp;") {
    p.remove();
  }
});

// newsletter subscribe watcher

document.addEventListener("DOMContentLoaded", function () {
  // Get references to the form elements using the form's ID

  const form = document.querySelector("#wpcf7-f59-o2"); // Target the form by its ID

  const emailInput = form.querySelector("input.wpcf7-email"); // Select email input within this form

  const agreeInfoCheckbox = form.querySelector('input[name="agree-info[]"]'); // Select checkbox using name attribute

  const agreePrivacyCheckbox = form.querySelector(
    'input[name="agree-privacy[]',
  ); // Select checkbox by its ID

  const submitButton = form.querySelector("#subscribe-button");

  // Function to check if the conditions are met

  function checkConditions() {
    const isEmailFilled = emailInput.value.trim() !== ""; // Check if the email input is filled

    const areBoxesTicked =
      agreeInfoCheckbox.checked &&
      agreePrivacyCheckbox &&
      agreePrivacyCheckbox.checked; // Check if both checkboxes are ticked

    // Log the current state of conditions

    // console.log("Email Filled: ", isEmailFilled);

    // console.log("Agree Info Checkbox Checked: ", agreeInfoCheckbox.checked);

    // console.log("Agree Privacy Checkbox Checked: ", agreePrivacyCheckbox.checked);

    // Enable/Disable the submit button based on the conditions

    if (isEmailFilled && areBoxesTicked) {
      // console.log("Conditions met. Enabling submit button.");

      submitButton.disabled = false; // Enable submit button
    } else {
      // console.log("Conditions not met. Disabling submit button.");

      submitButton.disabled = true; // Disable submit button
    }
  }

  // Run the check initially

  checkConditions();

  // Add event listeners to the form elements to check conditions when they change

  emailInput.addEventListener("input", checkConditions);

  agreeInfoCheckbox.addEventListener("change", checkConditions);

  agreePrivacyCheckbox.addEventListener("change", checkConditions);

  // Event delegation for dynamic content or further checks

  form.addEventListener("change", function (event) {
    if (
      event.target === agreePrivacyCheckbox ||
      event.target === agreeInfoCheckbox ||
      event.target === emailInput
    ) {
      checkConditions(); // Recheck conditions when any of the inputs change
    }
  });
});

//about contact us watcher

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#wpcf7-f193-o1");

  if (!form) return;

  const firstNameInput = form.querySelector("#first-name");

  const lastNameInput = form.querySelector("#last-name");

  const emailInput = form.querySelector("#email");

  const mobileInput = form.querySelector("#mobile-number");

  const messageInput = form.querySelector("#message");

  const agreePrivacyCheckbox = form.querySelector(
    'input[name="agree-privacy[]"]',
  );

  const submitButton = form.querySelector("#subscribe-button");

  if (
    !firstNameInput ||
    !lastNameInput ||
    !emailInput ||
    !mobileInput ||
    !messageInput ||
    !agreePrivacyCheckbox ||
    !submitButton
  ) {
    return;
  }

  function checkConditions() {
    const isFirstNameFilled = firstNameInput.value.trim() !== "";

    const isLastNameFilled = lastNameInput.value.trim() !== "";

    const isEmailFilled = emailInput.value.trim() !== "";

    const isMobileFilled = mobileInput.value.trim() !== "";

    const isMessageFilled = messageInput.value.trim() !== "";

    const isPrivacyChecked = agreePrivacyCheckbox.checked;

    submitButton.disabled = !(
      isFirstNameFilled &&
      isLastNameFilled &&
      isEmailFilled &&
      isMobileFilled &&
      isMessageFilled &&
      isPrivacyChecked
    );
  }

  checkConditions();

  firstNameInput.addEventListener("input", checkConditions);

  lastNameInput.addEventListener("input", checkConditions);

  emailInput.addEventListener("input", checkConditions);

  mobileInput.addEventListener("input", checkConditions);

  messageInput.addEventListener("input", checkConditions);

  agreePrivacyCheckbox.addEventListener("change", checkConditions);
});

// Careers/contact form watcher

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#wpcf7-f270-o1");

  if (!form) return;

  const firstNameInput = form.querySelector("#first-name");

  const lastNameInput = form.querySelector("#last-name");

  const emailInput = form.querySelector("#email");

  const resumeInput = form.querySelector("#resume-upload");

  const messageInput = form.querySelector("#message");

  const agreePrivacyCheckbox = form.querySelector(
    'input[name="agree-privacy[]"]',
  );

  const submitButton = form.querySelector("#subscribe-button");

  if (
    !firstNameInput ||
    !lastNameInput ||
    !emailInput ||
    !resumeInput ||
    !messageInput ||
    !agreePrivacyCheckbox ||
    !submitButton
  ) {
    return;
  }

  function checkConditions() {
    const isFirstNameFilled = firstNameInput.value.trim() !== "";

    const isLastNameFilled = lastNameInput.value.trim() !== "";

    const isEmailFilled = emailInput.value.trim() !== "";

    const isResumeUploaded = resumeInput.files.length > 0;

    const isMessageFilled = messageInput.value.trim() !== "";

    const isPrivacyChecked = agreePrivacyCheckbox.checked;

    submitButton.disabled = !(
      isFirstNameFilled &&
      isLastNameFilled &&
      isEmailFilled &&
      isResumeUploaded &&
      isMessageFilled &&
      isPrivacyChecked
    );
  }

  checkConditions();

  firstNameInput.addEventListener("input", checkConditions);

  lastNameInput.addEventListener("input", checkConditions);

  emailInput.addEventListener("input", checkConditions);

  resumeInput.addEventListener("change", checkConditions);

  messageInput.addEventListener("input", checkConditions);

  agreePrivacyCheckbox.addEventListener("change", checkConditions);
});

//International Form watcher
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#wpcf7-f873-o1"); // change this to the correct CF7 form wrapper ID

  if (!form) return;

  const firstNameInput = form.querySelector("#first-name");
  const lastNameInput = form.querySelector("#last-name");
  const countrySelect = form.querySelector("#country-select");
  const mobileInput = form.querySelector("#mobile-number");
  const emailInput = form.querySelector("#email");
  const propertySelect = form.querySelector("#property-select");
  const messageInput = form.querySelector("#message");

  const agreeInfoCheckbox = form.querySelector('input[name="agree-info[]"]');
  const agreePrivacyCheckbox = form.querySelector(
    'input[name="agree-privacy[]"]',
  );

  const submitButton = form.querySelector("#subscribe-button");

  if (
    !firstNameInput ||
    !lastNameInput ||
    !countrySelect ||
    !mobileInput ||
    !emailInput ||
    !propertySelect ||
    !messageInput ||
    !agreeInfoCheckbox ||
    !agreePrivacyCheckbox ||
    !submitButton
  ) {
    return;
  }

  function hasValue(field) {
    return field && field.value.trim() !== "";
  }

  function checkConditions() {
    const isFirstNameFilled = hasValue(firstNameInput);
    const isLastNameFilled = hasValue(lastNameInput);
    const isCountrySelected = hasValue(countrySelect);
    const isMobileFilled = hasValue(mobileInput);
    const isEmailFilled = hasValue(emailInput);
    const isPropertySelected = hasValue(propertySelect);
    const isMessageFilled = hasValue(messageInput);

    const isInfoChecked = agreeInfoCheckbox.checked;
    const isPrivacyChecked = agreePrivacyCheckbox.checked;

    submitButton.disabled = !(
      isFirstNameFilled &&
      isLastNameFilled &&
      isCountrySelected &&
      isMobileFilled &&
      isEmailFilled &&
      isPropertySelected &&
      isMessageFilled &&
      isInfoChecked &&
      isPrivacyChecked
    );
  }

  checkConditions();

  firstNameInput.addEventListener("input", checkConditions);
  lastNameInput.addEventListener("input", checkConditions);
  countrySelect.addEventListener("change", checkConditions);
  mobileInput.addEventListener("input", checkConditions);
  emailInput.addEventListener("input", checkConditions);
  propertySelect.addEventListener("change", checkConditions);
  messageInput.addEventListener("input", checkConditions);
  agreeInfoCheckbox.addEventListener("change", checkConditions);
  agreePrivacyCheckbox.addEventListener("change", checkConditions);

  if (window.jQuery) {
    jQuery(countrySelect).on(
      "select2:select select2:clear change",
      checkConditions,
    );
    jQuery(propertySelect).on(
      "select2:select select2:clear change",
      checkConditions,
    );
  }

  document.addEventListener("wpcf7reset", function () {
    setTimeout(checkConditions, 100);
  });
});

//submenu hover

document.addEventListener("DOMContentLoaded", function () {
  // Define your pairs of elements here

  const elementPairs = [
    {
      trigger: document.getElementById("aboutUsWeb"),

      target: document.getElementById("subAboutUs"),
    },

    {
      trigger: document.getElementById("businessesWeb"),

      target: document.getElementById("subBusiness"),
    },

    {
      trigger: document.getElementById("newDevelopmentsWeb"),

      target: document.getElementById("subDevelopment"),
    },

    {
      trigger: document.getElementById("curatedSpacesWeb"),

      target: document.getElementById("subCuratedSpaces"),
    },
  ];

  // Loop through each pair and add the event listeners

  elementPairs.forEach((pair) => {
    if (pair.trigger && pair.target) {
      // When hovering over the trigger element, add the "active" class to the target

      pair.trigger.addEventListener("mouseover", function () {
        pair.target.classList.add("active");
      });

      // When leaving the trigger element, check if the cursor is still on the target element

      pair.trigger.addEventListener("mouseleave", function () {
        if (!pair.target.matches(":hover")) {
          pair.target.classList.remove("active");
        }
      });

      // When leaving the target element, remove the "active" class

      pair.target.addEventListener("mouseleave", function () {
        if (!pair.trigger.matches(":hover")) {
          pair.target.classList.remove("active");
        }
      });
    }
  });
});

// mobile submenu-inner

document.querySelectorAll(".sublink-submenu").forEach((link) => {
  link.addEventListener("click", function (e) {
    const targetId = this.id + "Inner";

    const targetSubmenu = document.getElementById(targetId);

    // 👉 If NO matching submenu  allow default link behavior

    if (!targetSubmenu) {
      return; // do nothing, browser follows href
    }

    //  If submenu exists → prevent navigation and do toggle

    e.preventDefault();

    const mainMenu = document.querySelector(".submenu-grid.main");

    if (mainMenu) {
      mainMenu.classList.add("hidden");
    }

    targetSubmenu.classList.add("active");
  });
});

// mobile submenu-back button

document.querySelectorAll(".back-button").forEach((button) => {
  button.addEventListener("click", function (e) {
    e.preventDefault();

    const currentInner = this.closest(".submenu-grid.inner");

    const mainMenu = document.querySelector(".submenu-grid.main");

    // Hide the current submenu

    if (currentInner) {
      currentInner.classList.remove("active");
    }

    // Show the main menu again

    if (mainMenu) {
      mainMenu.classList.remove("hidden");
    }
  });
});

//contact form validation

// document.querySelectorAll('.homepage-contact form').forEach(form => {

//   const submitBtn = form.querySelector('input[type="submit"]');

//   const requiredFields = form.querySelectorAll('.wpcf7-validates-as-required');

//   const emailInput = form.querySelector('input[type="email"]');

//   const mobileInput = form.querySelector('input[name="mobile-number"]');

//   // Disable submit initially

//   submitBtn.disabled = true;

//   if (mobileInput) {

//     mobileInput.addEventListener('input', function () {

//       this.value = this.value.replace(/\D/g, '');

//     });

//   }

//   function isValidEmail(email) {

//     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

//   }

//   //  Email blur validation

// if (emailInput) {

//   emailInput.addEventListener('blur', function () {

//     const value = this.value.trim();

//     // Remove previous state

//     this.classList.remove('error');

//     // Only validate if user typed something

//     if (!value) return;

//     if (!isValidEmail(value)) {

//       this.classList.add('error');

//     }

//   });

// }

//   function checkForm() {

//     let allFilled = true;

//     requiredFields.forEach(field => {

//       if (!field.value.trim()) {

//         allFilled = false;

//       }

//     });

//     // Extra email check

//     if (emailInput && !isValidEmail(emailInput.value.trim())) {

//       allFilled = false;

//     }

//     submitBtn.disabled = !allFilled;

//   }

//   // Listen to input changes

//   requiredFields.forEach(field => {

//     field.addEventListener('input', checkForm);

//   });

// });

document
  .querySelectorAll(".homepage-contact form, .homepage-newsletter form")
  .forEach((form) => {
    const submitBtn = form.querySelector('input[type="submit"]');

    const requiredFields = form.querySelectorAll(
      "input.wpcf7-validates-as-required, textarea.wpcf7-validates-as-required, select.wpcf7-validates-as-required",
    );

    const emailInput = form.querySelector('input[type="email"]');

    const mobileInput = form.querySelector('input[name="mobile-number"]');

    // Disable submit initially

    if (submitBtn) {
      submitBtn.disabled = true;
    }

    if (mobileInput) {
      mobileInput.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "");
      });
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Email blur validation

    if (emailInput) {
      emailInput.addEventListener("blur", function () {
        const value = this.value.trim();

        // Remove previous state

        this.classList.remove("error");

        // Only validate if user typed something

        if (!value) return;

        if (!isValidEmail(value)) {
          this.classList.add("error");
        }
      });
    }

    function checkForm() {
      let allFilled = true;

      requiredFields.forEach((field) => {
        if (field.type === "checkbox" || field.type === "radio") {
          const checkedField = form.querySelector(
            `input[name="${field.name}"]:checked`,
          );

          if (!checkedField) {
            allFilled = false;
          }
        } else if (!field.value || !field.value.trim()) {
          allFilled = false;
        }
      });

      // Extra email check

      if (emailInput && !isValidEmail(emailInput.value.trim())) {
        allFilled = false;
      }

      if (submitBtn) {
        submitBtn.disabled = !allFilled;
      }
    }

    // Listen to input changes

    requiredFields.forEach((field) => {
      field.addEventListener("input", checkForm);

      field.addEventListener("change", checkForm);
    });

    checkForm();
  });

//accordion .active toggle

document.addEventListener("DOMContentLoaded", function () {
  const itemTitles = document.querySelectorAll(".accordion-item > .item-title");

  itemTitles.forEach(function (itemTitle) {
    itemTitle.addEventListener("click", function () {
      const accordionItem = itemTitle.closest(".accordion-item");

      if (accordionItem) {
        accordionItem.classList.toggle("active");
      }
    });
  });

  const subUploadTitles = document.querySelectorAll(
    ".sub-upload-group > .sub-upload-title",
  );

  subUploadTitles.forEach(function (subUploadTitle) {
    subUploadTitle.addEventListener("click", function (event) {
      event.stopPropagation();

      const subUploadGroup = subUploadTitle.closest(".sub-upload-group");

      if (subUploadGroup) {
        subUploadGroup.classList.toggle("active");
      }
    });
  });
});

//pseudo-upload

document.addEventListener("DOMContentLoaded", function () {
  const uploadInput = document.getElementById("resume-upload");

  const uploadButton = document.getElementById("resume-upload-button");

  if (!uploadInput || !uploadButton) return;

  uploadButton.addEventListener("click", function () {
    uploadInput.click();
  });
});

// Residentials Filter Box

document.addEventListener("DOMContentLoaded", function () {
  const filterButton = document.querySelector("a#residentialsFilter");

  const filterBox = document.querySelector("div#residentialsFilterBox");

  if (!filterButton || !filterBox) return;

  filterButton.addEventListener("click", function (e) {
    e.preventDefault();

    filterBox.classList.toggle("active");
  });
});

// Residentials Grid Filter

jQuery(function ($) {
  const $grid = $("#residentialsGrid");

  $("#applyFilter").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: "/wp-admin/admin-ajax.php",

      type: "POST",

      data: {
        action: "filter_residentials",

        locations: $('input[name="location[]"]:checked')
          .map(function () {
            return this.value;
          })
          .get(),

        property_type: $('input[name="property_type"]:checked').val(),

        property_status: $('input[name="property_status"]:checked').val(),
      },

      beforeSend: function () {
        $grid.addClass("is-filtering");
      },

      success: function (response) {
        setTimeout(function () {
          $grid.html(response);

          $grid.removeClass("is-filtering");
        }, 200);
      },

      complete: function () {
        $grid.removeClass("loading");
      },
    });
  });

  $("#clearButton").on("click", function (e) {
    e.preventDefault();

    $('input[name="location[]"]').prop("checked", false);

    $('input[name="property_type"][value="default-type"]').prop(
      "checked",
      true,
    );

    $('input[name="property_status"][value="default-status"]').prop(
      "checked",
      true,
    );

    $("#applyFilter").trigger("click");
  });
});

// Enterprise Carousel

jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#enterpriseCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#enterpriseCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#enterpriseCarousel .carousel-status").text(current + " / " + total);
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#enterpriseCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Assembly Grounds Carousel

jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#assemblyGroundsCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#assemblyGroundsCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#assemblyGroundsCarousel .carousel-status").text(
      current + " / " + total,
    );
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#assemblyGroundsCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Shangri-La Plaza Carousel

jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#shangriLaPlazaCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#shangriLaPlazaCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#shangriLaPlazaCarousel .carousel-status").text(current + " / " + total);
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#shangriLaPlazaCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Shangri-La at the Fort Carousel
jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#shangriLaFortCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#shangriLaFortCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#shangriLaFortCarousel .carousel-status").text(current + " / " + total);
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#shangriLaFortCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Curated Space Lifestyle Carousel
jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#curatedLifestyleCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#curatedLifestyleCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#curatedLifestyleCarousel .carousel-status").text(
      current + " / " + total,
    );
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#curatedLifestyleCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Curated Space Amenities Carousel
jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#curatedAmenitiesCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#curatedAmenitiesCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#curatedAmenitiesCarousel .carousel-status").text(
      current + " / " + total,
    );
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#curatedAmenitiesCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Curated Space Security Carousel
jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#curatedSecurityCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#curatedSecurityCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#curatedSecurityCarousel .carousel-status").text(
      current + " / " + total,
    );
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#curatedSecurityCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

// Curated Space Wellness Carousel
jQuery(document).ready(function ($) {
  // Initialize Flickity on the correct carousel

  var $carousel = $("#curatedWellnessCarousel .video-carousel");

  var flickityInstance = $carousel.flickity({
    cellAlign: "left",

    contain: true,

    prevNextButtons: true,

    pageDots: false,

    draggable: false,
  });

  // Move prev/next buttons to navigation container

  setTimeout(function () {
    var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

    var $nextButton = $carousel.find(".flickity-prev-next-button.next");

    $("#curatedWellnessCarousel .carousel-buttons")
      .append($prevButton)
      .append($nextButton);
  }, 100);

  // Slide counter

  function updateStatus(index) {
    var totalSlides = $carousel.flickity("getCellElements").length;

    // Add leading zero for numbers less than 10

    var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

    var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

    $("#curatedWellnessCarousel .carousel-status").text(
      current + " / " + total,
    );
  }

  updateStatus(0);

  $carousel.on("change.flickity", function (event, index) {
    updateStatus(index);
  });

  // Photo modal: open full image

  $("#curatedWellnessCarousel .carousel-thumbnail").on("click", function () {
    var fullUrl = $(this).data("full"); // must exist

    var altText = $(this).attr("alt");

    $("#photo-container").attr("src", fullUrl).attr("alt", altText);

    $("#photo-modal").addClass("active").fadeIn();
  });

  // Close modal

  $(".close-btn, #photo-modal").on("click", function (e) {
    if (e.target !== this) return;

    $("#photo-modal").removeClass("active").fadeOut();

    $("#photo-container").attr("src", "").attr("alt", "");
  });

  // Replace Flickity arrows with SVG

  (function replaceArrows() {
    const prev = $carousel[0].querySelector(
      ".flickity-prev-next-button.previous",
    );

    const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

    if (!prev || !next) return false;

    prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

    next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

    return true;
  })();
});

//Curated Space Modal
jQuery(document).ready(function ($) {
  $(".curated-space-image .image-content").on("click", function () {
    var $trigger = $(this);
    var fullUrl = $trigger.data("full");
    var altText = $trigger.find(".image-block img").attr("alt") || "";
    var $section = $trigger.closest(".curated-space-image");
    var $modal = $section.next(".curated-space-image-modal");

    $modal.find(".photo-within").attr("src", fullUrl).attr("alt", altText);

    $modal.addClass("active").fadeIn();
  });

  $(".curated-space-image-modal .close-btn, .curated-space-image-modal").on(
    "click",
    function (e) {
      if (e.target !== this) return;

      var $modal = $(this).hasClass("curated-space-image-modal")
        ? $(this)
        : $(this).closest(".curated-space-image-modal");

      $modal.removeClass("active").fadeOut();

      $modal.find(".photo-within").attr("src", "").attr("alt", "");
    },
  );
});

// Curated Space Video Modal
jQuery(document).ready(function ($) {
  $(".curated-space-video .video-content").on("click", function () {
    var $trigger = $(this);
    var videoUrl = $trigger.data("video");
    var $section = $trigger.closest(".curated-space-video");
    var $modal = $section.next(".curated-space-video-modal");

    var embedUrl = videoUrl;

    if (videoUrl.indexOf("watch?v=") > -1) {
      embedUrl = videoUrl.replace("watch?v=", "embed/");
    }

    if (embedUrl.indexOf("?") > -1) {
      embedUrl += "&autoplay=1";
    } else {
      embedUrl += "?autoplay=1";
    }

    $modal.find(".video-within").attr("src", embedUrl);

    $modal.addClass("active").fadeIn();
  });

  $(".curated-space-video-modal .close-btn, .curated-space-video-modal").on(
    "click",
    function (e) {
      if (e.target !== this) return;

      var $modal = $(this).hasClass("curated-space-video-modal")
        ? $(this)
        : $(this).closest(".curated-space-video-modal");

      $modal.removeClass("active").fadeOut();

      $modal.find(".video-within").attr("src", "");
    },
  );
});

//Privacy Notice Nav Tabs
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".privacy-notice-tabs").forEach((section) => {
    const buttons = section.querySelectorAll(".privacy-tab-btn");
    const panels = section.querySelectorAll(".privacy-tab-panel");

    buttons.forEach((button) => {
      button.addEventListener("click", function () {
        const target = this.dataset.tab;

        buttons.forEach((btn) => btn.classList.remove("active"));
        panels.forEach((panel) => panel.classList.remove("active"));

        this.classList.add("active");

        const activePanel = section.querySelector("#" + target);

        if (activePanel) {
          activePanel.classList.add("active");
        }
      });
    });
  });
});

//Socmed Sharers
document.addEventListener("DOMContentLoaded", function () {
  const pageUrl = encodeURIComponent(window.location.href);
  const pageTitle = encodeURIComponent(document.title);

  document.querySelector(".share-facebook").href =
    "https://www.facebook.com/sharer/sharer.php?u=" + pageUrl;

  document.querySelector(".share-x").href =
    "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + pageTitle;

  document.querySelector(".share-linkedin").href =
    "https://www.linkedin.com/sharing/share-offsite/?url=" + pageUrl;

  document.querySelector(".copy-link").addEventListener("click", function (e) {
    e.preventDefault();

    navigator.clipboard.writeText(window.location.href).then(function () {
      alert("Copied!");
    });
  });
});

// News & Updates Filter Box

document.addEventListener("DOMContentLoaded", function () {
  const filterButton = document.querySelector("a#newsUpdatesFilter");

  const filterBox = document.querySelector("div#newsUpdatesFilterBox");

  if (!filterButton || !filterBox) return;

  filterButton.addEventListener("click", function (e) {
    e.preventDefault();

    filterBox.classList.toggle("active");
  });
});

// News & Updates Grid Filter

jQuery(function ($) {
  const $grid = $("#newsUpdatesGrid");

  if (!$grid.length) return;

  $(document).on("click", "#applyNewsUpdatesFilter", function (e) {
    e.preventDefault();

    const selectedCategories = $('input[name="news_category[]"]:checked')
      .map(function () {
        return this.value;
      })
      .get();

    console.log("Selected categories:", selectedCategories);

    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "filter_news_updates",
        categories: selectedCategories,
      },

      beforeSend: function () {
        $grid.addClass("is-filtering");
      },

      success: function (response) {
        console.log("AJAX HTML response:", response);
        $grid.html(response);
      },

      error: function (xhr, status, error) {
        console.log("AJAX failed");
        console.log("Status:", status);
        console.log("Error:", error);
        console.log("Response text:", xhr.responseText);

        $grid.html('<p class="no-results">AJAX failed. Check console.</p>');
      },

      complete: function () {
        $grid.removeClass("is-filtering");
      },
    });
  });

  $(document).on("click", "#clearNewsUpdatesFilter", function (e) {
    e.preventDefault();

    $('input[name="news_category[]"]').prop("checked", false);
    $("#applyNewsUpdatesFilter").trigger("click");
  });
});

// News & Updates Load More only
jQuery(function ($) {
  const $grid = $("#newsUpdatesGrid");
  const $loadMoreWrap = $("#newsUpdatesLoadMoreWrap");
  const $loadMoreBtn = $("#newsUpdatesLoadMore");
  const batchSize = 6;

  if (!$grid.length || !$loadMoreBtn.length) return;

  function hideLoadMore() {
    $loadMoreWrap.addClass("news-load-more-fading");

    setTimeout(function () {
      $loadMoreWrap.addClass("news-load-more-hidden");
    }, 350);
  }

  function showLoadMore() {
    $loadMoreWrap.removeClass("news-load-more-hidden");

    setTimeout(function () {
      $loadMoreWrap.removeClass("news-load-more-fading");
    }, 20);
  }

  function revealItems($items) {
    $items.each(function (index) {
      const $item = $(this);

      setTimeout(function () {
        $item.removeClass("news-item-hidden").addClass("news-item-reveal");

        setTimeout(function () {
          $item.removeClass("news-item-reveal");
        }, 500);
      }, index * 80);
    });
  }

  function resetLoadMore() {
    const $items = $grid.find(".grid-item");

    $items.removeClass("news-item-hidden news-item-reveal");

    if ($items.length <= batchSize) {
      hideLoadMore();
      return;
    }

    $items.each(function (index) {
      if (index >= batchSize) {
        $(this).addClass("news-item-hidden");
      }
    });

    showLoadMore();
  }

  function updateLoadMoreButton() {
    const hiddenCount = $grid.find(".grid-item.news-item-hidden").length;

    if (hiddenCount > 0) {
      showLoadMore();
    } else {
      hideLoadMore();
    }
  }

  $(document).on("click", "#newsUpdatesLoadMore", function (e) {
    e.preventDefault();

    const $hiddenItems = $grid.find(".grid-item.news-item-hidden");
    const $nextBatch = $hiddenItems.slice(0, batchSize);

    revealItems($nextBatch);

    setTimeout(
      function () {
        updateLoadMoreButton();
      },
      $nextBatch.length * 80 + 500,
    );
  });

  resetLoadMore();

  const observer = new MutationObserver(function () {
    resetLoadMore();
  });

  observer.observe($grid[0], {
    childList: true,
  });
});

//Sort

// News & Updates Sort
jQuery(function ($) {
  const $grid = $("#newsUpdatesGrid");
  const $sortContainer = $(".sort-by-container");
  const $sortButton = $("#newsUpdatesSort");
  const $sortCurrent = $("#newsUpdatesSortCurrent");
  const batchSize = 6;

  if (!$grid.length || !$sortButton.length) return;

  let currentSort = $sortButton.attr("data-current-sort") || "oldest";
  let isSorting = false;

  function resetLoadMoreAfterSort() {
    const $items = $grid.find(".grid-item");
    const $loadMoreWrap = $("#newsUpdatesLoadMoreWrap");

    $items.removeClass("news-item-hidden news-item-reveal");

    if (!$items.length || $items.length <= batchSize) {
      $loadMoreWrap.addClass("news-load-more-fading");

      setTimeout(function () {
        $loadMoreWrap.addClass("news-load-more-hidden");
      }, 350);

      return;
    }

    $items.each(function (index) {
      if (index >= batchSize) {
        $(this).addClass("news-item-hidden");
      }
    });

    $loadMoreWrap.removeClass("news-load-more-hidden");

    setTimeout(function () {
      $loadMoreWrap.removeClass("news-load-more-fading");
    }, 20);
  }

  function getItemTitle(item) {
    const $item = $(item);
    return ($item.attr("data-title") || $item.find("h3").text() || "")
      .toLowerCase()
      .trim();
  }

  function getItemDate(item) {
    const $item = $(item);
    return parseInt($item.attr("data-date"), 10) || 0;
  }

  function sortNewsItems(sortType) {
    const items = $grid.find(".grid-item").get();

    if (!items.length) {
      resetLoadMoreAfterSort();
      return;
    }

    items.sort(function (a, b) {
      const titleA = getItemTitle(a);
      const titleB = getItemTitle(b);
      const dateA = getItemDate(a);
      const dateB = getItemDate(b);

      if (sortType === "newest") {
        return dateB - dateA;
      }

      if (sortType === "oldest") {
        return dateA - dateB;
      }

      if (sortType === "az") {
        return titleA.localeCompare(titleB);
      }

      if (sortType === "za") {
        return titleB.localeCompare(titleA);
      }

      return 0;
    });

    isSorting = true;

    $.each(items, function (_, item) {
      $grid.append(item);
    });

    resetLoadMoreAfterSort();

    setTimeout(function () {
      isSorting = false;
    }, 0);
  }

  $(document).on("click", "#newsUpdatesSort", function (e) {
    e.preventDefault();

    $sortContainer.toggleClass("is-open");
  });

  $(document).on("click", ".news-sort-option", function (e) {
    e.preventDefault();

    const $option = $(this);
    const sortType = $option.data("sort");
    const sortLabel = $option.text().trim();

    currentSort = sortType;

    $sortButton.attr("data-current-sort", sortType);
    $sortCurrent.text(sortLabel);

    $(".news-sort-option").removeClass("is-active");
    $option.addClass("is-active");

    $sortContainer.removeClass("is-open");

    sortNewsItems(currentSort);
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".sort-by-container").length) {
      $sortContainer.removeClass("is-open");
    }
  });

  const observer = new MutationObserver(function () {
    if (isSorting) return;

    setTimeout(function () {
      sortNewsItems(currentSort);
    }, 0);
  });

  observer.observe($grid[0], {
    childList: true,
  });

  sortNewsItems(currentSort);
});

// Blogs Filter Box
document.addEventListener("DOMContentLoaded", function () {
  const filterButton = document.querySelector("a#blogsFilter");
  const filterBox = document.querySelector("div#blogsFilterBox");

  if (!filterButton || !filterBox) return;

  filterButton.addEventListener("click", function (e) {
    e.preventDefault();

    filterBox.classList.toggle("active");
  });
});

// Blogs Grid Filter
jQuery(function ($) {
  const $grid = $("#blogsGrid");

  if (!$grid.length) return;

  $(document).on("click", "#applyBlogsFilter", function (e) {
    e.preventDefault();

    const selectedCategories = $('input[name="blog_category[]"]:checked')
      .map(function () {
        return this.value;
      })
      .get();

    console.log("Selected blog categories:", selectedCategories);

    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "filter_blogs",
        categories: selectedCategories,
      },

      beforeSend: function () {
        $grid.addClass("is-filtering");
      },

      success: function (response) {
        console.log("Blogs AJAX HTML response:", response);
        $grid.html(response);
      },

      error: function (xhr, status, error) {
        console.log("Blogs AJAX failed");
        console.log("Status:", status);
        console.log("Error:", error);
        console.log("Response text:", xhr.responseText);

        $grid.html('<p class="no-results">AJAX failed. Check console.</p>');
      },

      complete: function () {
        $grid.removeClass("is-filtering");
      },
    });
  });

  $(document).on("click", "#clearBlogsFilter", function (e) {
    e.preventDefault();

    $('input[name="blog_category[]"]').prop("checked", false);
    $("#applyBlogsFilter").trigger("click");
  });
});

// Blogs Load More only
jQuery(function ($) {
  const $grid = $("#blogsGrid");
  const $loadMoreWrap = $("#blogsLoadMoreWrap");
  const $loadMoreBtn = $("#blogsLoadMore");
  const batchSize = 6;

  if (!$grid.length || !$loadMoreBtn.length) return;

  function hideLoadMore() {
    $loadMoreWrap.addClass("news-load-more-fading");

    setTimeout(function () {
      $loadMoreWrap.addClass("news-load-more-hidden");
    }, 350);
  }

  function showLoadMore() {
    $loadMoreWrap.removeClass("news-load-more-hidden");

    setTimeout(function () {
      $loadMoreWrap.removeClass("news-load-more-fading");
    }, 20);
  }

  function revealItems($items) {
    $items.each(function (index) {
      const $item = $(this);

      setTimeout(function () {
        $item.removeClass("news-item-hidden").addClass("news-item-reveal");

        setTimeout(function () {
          $item.removeClass("news-item-reveal");
        }, 500);
      }, index * 80);
    });
  }

  function resetLoadMore() {
    const $items = $grid.find(".grid-item");

    $items.removeClass("news-item-hidden news-item-reveal");

    if ($items.length <= batchSize) {
      hideLoadMore();
      return;
    }

    $items.each(function (index) {
      if (index >= batchSize) {
        $(this).addClass("news-item-hidden");
      }
    });

    showLoadMore();
  }

  function updateLoadMoreButton() {
    const hiddenCount = $grid.find(".grid-item.news-item-hidden").length;

    if (hiddenCount > 0) {
      showLoadMore();
    } else {
      hideLoadMore();
    }
  }

  $(document).on("click", "#blogsLoadMore", function (e) {
    e.preventDefault();

    const $hiddenItems = $grid.find(".grid-item.news-item-hidden");
    const $nextBatch = $hiddenItems.slice(0, batchSize);

    revealItems($nextBatch);

    setTimeout(
      function () {
        updateLoadMoreButton();
      },
      $nextBatch.length * 80 + 500,
    );
  });

  resetLoadMore();

  const observer = new MutationObserver(function () {
    resetLoadMore();
  });

  observer.observe($grid[0], {
    childList: true,
  });
});

// Blogs Sort
jQuery(function ($) {
  const $grid = $("#blogsGrid");
  const $sortContainer = $(".blogs-sort-by-container");
  const $sortButton = $("#blogsSort");
  const $sortCurrent = $("#blogsSortCurrent");
  const batchSize = 6;

  if (!$grid.length || !$sortButton.length) return;

  let currentSort = $sortButton.attr("data-current-sort") || "oldest";
  let isSorting = false;

  function resetLoadMoreAfterSort() {
    const $items = $grid.find(".grid-item");
    const $loadMoreWrap = $("#blogsLoadMoreWrap");

    $items.removeClass("news-item-hidden news-item-reveal");

    if (!$items.length || $items.length <= batchSize) {
      $loadMoreWrap.addClass("news-load-more-fading");

      setTimeout(function () {
        $loadMoreWrap.addClass("news-load-more-hidden");
      }, 350);

      return;
    }

    $items.each(function (index) {
      if (index >= batchSize) {
        $(this).addClass("news-item-hidden");
      }
    });

    $loadMoreWrap.removeClass("news-load-more-hidden");

    setTimeout(function () {
      $loadMoreWrap.removeClass("news-load-more-fading");
    }, 20);
  }

  function getItemTitle(item) {
    const $item = $(item);

    return ($item.attr("data-title") || $item.find("h3").text() || "")
      .toLowerCase()
      .trim();
  }

  function getItemDate(item) {
    const $item = $(item);

    return parseInt($item.attr("data-date"), 10) || 0;
  }

  function sortBlogItems(sortType) {
    const items = $grid.find(".grid-item").get();

    if (!items.length) {
      resetLoadMoreAfterSort();
      return;
    }

    items.sort(function (a, b) {
      const titleA = getItemTitle(a);
      const titleB = getItemTitle(b);
      const dateA = getItemDate(a);
      const dateB = getItemDate(b);

      if (sortType === "newest") {
        return dateB - dateA;
      }

      if (sortType === "oldest") {
        return dateA - dateB;
      }

      if (sortType === "az") {
        return titleA.localeCompare(titleB);
      }

      if (sortType === "za") {
        return titleB.localeCompare(titleA);
      }

      return 0;
    });

    isSorting = true;

    $.each(items, function (_, item) {
      $grid.append(item);
    });

    resetLoadMoreAfterSort();

    setTimeout(function () {
      isSorting = false;
    }, 0);
  }

  $(document).on("click", "#blogsSort", function (e) {
    e.preventDefault();

    $sortContainer.toggleClass("is-open");
  });

  $(document).on("click", ".blogs-sort-option", function (e) {
    e.preventDefault();

    const $option = $(this);
    const sortType = $option.data("sort");
    const sortLabel = $option.text().trim();

    currentSort = sortType;

    $sortButton.attr("data-current-sort", sortType);
    $sortCurrent.text(sortLabel);

    $(".blogs-sort-option").removeClass("is-active");
    $option.addClass("is-active");

    $sortContainer.removeClass("is-open");

    sortBlogItems(currentSort);
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".blogs-sort-by-container").length) {
      $sortContainer.removeClass("is-open");
    }
  });

  const observer = new MutationObserver(function () {
    if (isSorting) return;

    setTimeout(function () {
      sortBlogItems(currentSort);
    }, 0);
  });

  observer.observe($grid[0], {
    childList: true,
  });

  sortBlogItems(currentSort);
});

// AJAX Search Results Pagination with Fade
jQuery(function ($) {
  const $section = $(".search-results-posts");

  if (!$section.length) return;

  const $posts = $("#searchResultsPosts");
  const $pagination = $("#searchResultsPagination");
  const searchQuery = $section.data("search") || "";

  let isLoading = false;

  function loadSearchPage(page) {
    if (isLoading || !window.searchBlogAjax) return;

    isLoading = true;
    $section.addClass("is-loading");

    $.ajax({
      url: window.searchBlogAjax.ajaxurl,
      type: "POST",
      data: {
        action: "search_blog_results",
        nonce: window.searchBlogAjax.nonce,
        search: searchQuery,
        page: page,
      },
      success: function (response) {
        if (!response.success) {
          $posts.html(
            '<p class="no-results">Something went wrong. Please try again.</p>',
          );
          $pagination.empty();
          return;
        }

        setTimeout(function () {
          $posts.html(response.data.html);
          $pagination.html(response.data.pagination);

          $("html, body").animate(
            {
              scrollTop: $section.offset().top - 120,
            },
            300,
          );

          setTimeout(function () {
            $section.removeClass("is-loading");
          }, 50);
        }, 350);
      },
      error: function () {
        setTimeout(function () {
          $posts.html(
            '<p class="no-results">Something went wrong. Please try again.</p>',
          );
          $pagination.empty();

          setTimeout(function () {
            $section.removeClass("is-loading");
          }, 50);
        }, 350);
      },
      complete: function () {
        isLoading = false;
      },
    });
  }

  $(document).on(
    "click",
    "#searchResultsPagination .page-numbers",
    function (e) {
      e.preventDefault();

      const $button = $(this);

      if ($button.hasClass("current") || $button.is(":disabled")) return;

      const page = parseInt($button.attr("data-page"), 10);

      if (!page) return;

      loadSearchPage(page);
    },
  );
});

//Universal Carousel

// jQuery(document).ready(function ($) {
//   var $sections = $(".js-reusable-photo-carousel");

//   if (!$sections.length) return;
//   if (typeof $.fn.flickity !== "function") return;

//   $sections.each(function () {
//     var $section = $(this);
//     var $carousel = $section.find(".video-carousel").first();

//     if (!$carousel.length) return;

//     if ($carousel.data("shangReusablePhotoCarouselReady")) return;

//     var isAlreadyFlickity = $carousel.hasClass("flickity-enabled");

//     var $navigation = $section.nextAll(".carousel-navigation").first();
//     var $buttonsContainer = $navigation.find(".carousel-buttons").first();
//     var $status = $navigation.find(".carousel-status").first();

//     var $modal = $navigation
//       .nextAll(".enterprise-modal, .photo-modal, #photo-modal")
//       .first();

//     var $photoContainer = $modal
//       .find(".photo-container, #photo-container")
//       .first();

//     if (!isAlreadyFlickity) {
//       $carousel.flickity({
//         cellAlign: "left",
//         contain: true,
//         prevNextButtons: true,
//         pageDots: false,
//         draggable: false,
//       });
//     }

//     $carousel.data("shangReusablePhotoCarouselReady", true);

//     function padNumber(number) {
//       return number < 10 ? "0" + number : number;
//     }

//     function updateStatus(index) {
//       if (!$status.length) return;

//       var totalSlides = $carousel.flickity("getCellElements").length;
//       var current = padNumber(index + 1);
//       var total = padNumber(totalSlides);

//       $status.text(current + " / " + total);
//     }

//     function setArrowSvg($prevButton, $nextButton) {
//       if (!$prevButton.length || !$nextButton.length) return;

//       $prevButton.html(
//         '<svg width="41" height="11" viewBox="0 0 41 11">' +
//           '<path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>' +
//           "</svg>",
//       );

//       $nextButton.html(
//         '<svg width="41" height="11" viewBox="0 0 41 11">' +
//           '<g transform="translate(41, 11) rotate(180)">' +
//           '<path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>' +
//           "</g>" +
//           "</svg>",
//       );
//     }

//     setTimeout(function () {
//       var $prevButton = $carousel.find(".flickity-prev-next-button.previous");
//       var $nextButton = $carousel.find(".flickity-prev-next-button.next");

//       if (
//         $buttonsContainer.length &&
//         $prevButton.length &&
//         $nextButton.length
//       ) {
//         $buttonsContainer.empty().append($prevButton).append($nextButton);
//       }

//       setArrowSvg($prevButton, $nextButton);
//     }, 100);

//     var flkty = $carousel.data("flickity");

//     if (flkty) {
//       updateStatus(flkty.selectedIndex || 0);
//     } else {
//       updateStatus(0);
//     }

//     $carousel.off("change.shangReusableCarousel");
//     $carousel.on("change.shangReusableCarousel", function (event, index) {
//       updateStatus(index);
//     });

//     $section.find(".carousel-thumbnail").off("click.shangReusableCarousel");
//     $section
//       .find(".carousel-thumbnail")
//       .on("click.shangReusableCarousel", function () {
//         if (!$modal.length || !$photoContainer.length) return;

//         var fullUrl = $(this).data("full");
//         var altText = $(this).attr("alt") || "";

//         if (!fullUrl) return;

//         $photoContainer.attr("src", fullUrl).attr("alt", altText);
//         $modal.addClass("active").fadeIn();
//       });

//     function closeModal() {
//       if (!$modal.length || !$photoContainer.length) return;

//       $modal.removeClass("active").fadeOut();
//       $photoContainer.attr("src", "").attr("alt", "");
//     }

//     $modal.find(".close-btn").off("click.shangReusableCarousel");
//     $modal.find(".close-btn").on("click.shangReusableCarousel", function () {
//       closeModal();
//     });

//     $modal.off("click.shangReusableCarousel");
//     $modal.on("click.shangReusableCarousel", function (e) {
//       if (e.target !== this) return;
//       closeModal();
//     });
//   });
// });




// Split Carousel

jQuery(document).ready(function ($) {
  var $sections = $(".js-about-split-content-carousel");

  if (!$sections.length) return;
  if (typeof $.fn.flickity !== "function") return;

  $sections.each(function () {
    var $section = $(this);
    var $carousel = $section.find(".about-split-photo-carousel").first();

    if (!$carousel.length) return;
    if ($carousel.data("aboutSplitPhotoCarouselReady")) return;

    var $status = $section.find(".about-split-photo-carousel-status").first();
    var $prevButton = $section.find(".about-split-photo-carousel-prev").first();
    var $nextButton = $section.find(".about-split-photo-carousel-next").first();

    $carousel.flickity({
      cellSelector: ".about-split-photo-carousel-cell",
      cellAlign: "left",
      contain: true,
      wrapAround: false,
      prevNextButtons: false,
      pageDots: false,
      draggable: false,
      groupCells: false,
      imagesLoaded: true,
    });

    $carousel.data("aboutSplitPhotoCarouselReady", true);

    var flkty = $carousel.data("flickity");

    if (!flkty) return;

    function padNumber(number) {
      return number < 10 ? "0" + number : number;
    }

    function updateStatus() {
      var totalSlides = flkty.cells.length;
      var currentSlide = flkty.selectedIndex + 1;

      if ($status.length) {
        $status.text(padNumber(currentSlide) + " / " + padNumber(totalSlides));
      }

      if ($prevButton.length) {
        $prevButton
          .prop("disabled", flkty.selectedIndex === 0)
          .toggleClass("is-disabled", flkty.selectedIndex === 0);
      }

      if ($nextButton.length) {
        $nextButton
          .prop("disabled", flkty.selectedIndex === totalSlides - 1)
          .toggleClass("is-disabled", flkty.selectedIndex === totalSlides - 1);
      }
    }

    updateStatus();

    flkty.on("change", function () {
      updateStatus();
    });

    $prevButton.off("click.aboutSplitPhotoCarousel");
    $prevButton.on("click.aboutSplitPhotoCarousel", function (e) {
      e.preventDefault();

      if ($(this).prop("disabled")) return;

      $carousel.flickity("previous");
    });

    $nextButton.off("click.aboutSplitPhotoCarousel");
    $nextButton.on("click.aboutSplitPhotoCarousel", function (e) {
      e.preventDefault();

      if ($(this).prop("disabled")) return;

      $carousel.flickity("next");
    });
  });
});

//AOS init
window.addEventListener("load", function () {
  AOS.init({
    once: true,
    duration: 800,
    easing: "ease-out",
  });

  AOS.refreshHard();
});

//Split Fade Animation
// document.addEventListener("DOMContentLoaded", function () {
//   const sections = document.querySelectorAll(
//     "section.split-fade-normal, section.split-fade-reverse",
//   );

//   sections.forEach(function (section) {
//     const headingContent = section.querySelector(".heading-content");
//     const customContent = section.querySelector(".custom-content");

//     let headingAnimation = "fade-right";
//     let customAnimation = "fade-left";

//     if (section.classList.contains("split-fade-reverse")) {
//       headingAnimation = "fade-left";
//       customAnimation = "fade-right";
//     }

//     if (headingContent) {
//       headingContent.setAttribute("data-aos", headingAnimation);
//       headingContent.setAttribute("data-aos-duration", "1500");
//     }

//     if (customContent) {
//       customContent.setAttribute("data-aos", customAnimation);
//       customContent.setAttribute("data-aos-duration", "1500");
//     }
//   });

//   if (typeof AOS !== "undefined") {
//     AOS.refreshHard();
//   }
// });

// Nav highlight
document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname.toLowerCase();

  document.querySelectorAll("#webNav .nav-link").forEach(function (link) {
    link.classList.remove("highlighted");
  });

  function matchesSlug(slug) {
    slug = slug.replace(/^\/|\/$/g, "");
    const regex = new RegExp("(^|/)" + slug + "(/|$)");
    return regex.test(currentPath);
  }

  function matchesAny(slugs) {
    return slugs.some(matchesSlug);
  }

  if (matchesSlug("about-us")) {
    document.getElementById("aboutUsWeb")?.classList.add("highlighted");
  } else if (
    matchesAny([
      "businesses",
      "residentials",
      "offices",
      "malls",
      "management-office",
      "hospitalities",
    ])
  ) {
    document.getElementById("businessesWeb")?.classList.add("highlighted");
  } else if (matchesSlug("new-developments")) {
    document.getElementById("newDevelopmentsWeb")?.classList.add("highlighted");
  } else if (matchesSlug("curated-spaces")) {
    document.getElementById("curatedSpacesWeb")?.classList.add("highlighted");
  }
});


// Smooth Scroll Inquire Now Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('shangPropManageServicesInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll Enterprise About Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('enterpriseAboutInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll Horizon Homes Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('horizonHomesInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll One Shangri-La Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('oneShangriLaInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll Shang Salcedo Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('shangSalcedoInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll Shang Grand Tower Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('shangGrandTowerInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

// Smooth Scroll St Francis Inquire Button
document.addEventListener('DOMContentLoaded', function () {
    const inquireButton = document.getElementById('shangStFrancisInquire');
    const newsletterSection = document.querySelector('section.homepage-newsletter');

    if (!inquireButton || !newsletterSection) return;

    inquireButton.addEventListener('click', function (event) {
        event.preventDefault();

        const offset = 320;
        const targetPosition =
            newsletterSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});


//Read More - Arrow links re-insert
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.arrow-cta').forEach(function (arrowCta) {
        const arrowLink = arrowCta.querySelector('a.arrow-link');
        let arrowIcons = null;

        Array.from(arrowCta.children).forEach(function (child) {
            if (child.classList.contains('arrow-icons')) {
                arrowIcons = child;
            }
        });

        if (!arrowLink || !arrowIcons) return;

        arrowLink.appendChild(arrowIcons);
    });
});


//Dropcap script
document.addEventListener('DOMContentLoaded', function () {
    document
        .querySelectorAll('.article-text__content--drop-cap')
        .forEach(function (content) {
            const firstParagraph = content.querySelector('p');

            if (!firstParagraph || firstParagraph.querySelector('strong.drop-cap')) {
                return;
            }

            const walker = document.createTreeWalker(
                firstParagraph,
                NodeFilter.SHOW_TEXT
            );

            let textNode;

            while ((textNode = walker.nextNode())) {
                const match = textNode.nodeValue.match(/\S/);

                if (!match) continue;

                const letterIndex = match.index;
                const beforeLetter = textNode.nodeValue.slice(0, letterIndex);
                const firstLetter = textNode.nodeValue.charAt(letterIndex);
                const afterLetter = textNode.nodeValue.slice(letterIndex + 1);

                const fragment = document.createDocumentFragment();

                if (beforeLetter) {
                    fragment.appendChild(document.createTextNode(beforeLetter));
                }

                const strong = document.createElement('strong');
                strong.classList.add('drop-cap');
                strong.textContent = firstLetter;

                fragment.appendChild(strong);

                if (afterLetter) {
                    fragment.appendChild(document.createTextNode(afterLetter));
                }

                textNode.parentNode.replaceChild(fragment, textNode);
                break;
            }
        });
});

// Shang Placeholder
document.addEventListener('DOMContentLoaded', function () {
    const placeholderImage =
        'https://shangproperties.com/wp-content/uploads/2026/07/post-featured-placeholder.png';

    function getPostLink(gridItem) {
        /*
         * Prefer the item's existing Read More/title link so the
         * placeholder uses the correct post permalink.
         */
        return gridItem.querySelector(
            '.item-cta a[href], ' +
            '.arrow-link[href], ' +
            '.post-link[href], ' +
            'h3 a[href], ' +
            'a[href]'
        );
    }

    function addPlaceholderImage(imageContainer) {
        /*
         * Do nothing when the container already has an image.
         */
        if (imageContainer.querySelector('img')) {
            return;
        }

        const gridItem = imageContainer.closest('.grid-item');

        if (!gridItem) {
            return;
        }

        const sourceLink = getPostLink(gridItem);

        /*
         * Do not create an invalid link when no permalink can be found.
         */
        if (!sourceLink) {
            return;
        }

        const permalink = sourceLink.getAttribute('href');

        if (!permalink || permalink === '#') {
            return;
        }

        const itemTitle =
            gridItem.dataset.title ||
            gridItem.querySelector('h3')?.textContent.trim() ||
            'Post featured image';

        /*
         * Create:
         *
         * .image-container
         * └── a
         *     └── span.wm-wrap.no-watermark
         *         └─ img
         */
        const imageLink = document.createElement('a');
        imageLink.href = permalink;

        /*
         * Copy the link behavior from the existing permalink.
         */
        if (sourceLink.target) {
            imageLink.target = sourceLink.target;
        }

        if (sourceLink.rel) {
            imageLink.rel = sourceLink.rel;
        }

        const watermarkWrapper = document.createElement('span');
        watermarkWrapper.className = 'wm-wrap no-watermark';

        const image = document.createElement('img');
        image.src = placeholderImage;
        image.alt = itemTitle;
        image.className =
            'attachment-large size-large wp-post-image aiwl-img';
        image.loading = 'lazy';
        image.decoding = 'async';

        watermarkWrapper.appendChild(image);
        imageLink.appendChild(watermarkWrapper);
        imageContainer.appendChild(imageLink);
    }

    function processEmptyImageContainers(parent = document) {
        /*
         * Process the parent itself when it is an image container.
         */
        if (
            parent.nodeType === Node.ELEMENT_NODE &&
            parent.matches('.grid-item .image-container')
        ) {
            addPlaceholderImage(parent);
        }

        /*
         * Process image containers found inside the parent.
         */
        if (parent.querySelectorAll) {
            parent
                .querySelectorAll('.grid-item .image-container')
                .forEach(addPlaceholderImage);
        }
    }

    /*
     * Process items already present when the page loads.
     */
    processEmptyImageContainers();

    /*
     * Also process dynamically loaded posts, such as AJAX pagination
     * or Load More results.
     */
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                processEmptyImageContainers(node);
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});

// Placeholder 2 - Journals
(function () {
    const placeholderImage =
        'https://shangproperties.com/wp-content/uploads/2026/07/post-featured-placeholder.png';

    function addRelatedPostPlaceholder(postDetails) {
        /*
         * Do nothing if .post-details already has an immediate <a> child.
         */
        if (postDetails.querySelector(':scope > a')) {
            return;
        }

        const relatedPost = postDetails.closest('.related-post');

        if (!relatedPost) {
            return;
        }

        /*
         * Get the permalink from another link within the same related post.
         */
        const sourceLink = relatedPost.querySelector(
            '.item-cta .arrow-link[href], ' +
            '.item-cta a[href], ' +
            'h3 a[href]'
        );

        if (!sourceLink) {
            return;
        }

        const permalink = sourceLink.getAttribute('href');

        if (!permalink || permalink === '#') {
            return;
        }

        const postTitle =
            postDetails.querySelector('h3')?.textContent.trim() ||
            relatedPost.dataset.title ||
            'Post featured image';

        /*
         * Create:
         *
         * .post-details
         * ├── a
         * │   └── span.wm-wrap.no-watermark
         * │       └── img
         * ├── .duration-details
         * ├── h3
         * ── p
         */
        const imageLink = document.createElement('a');
        imageLink.href = permalink;

        /*
         * Copy the existing permalink's link behavior.
         */
        if (sourceLink.target) {
            imageLink.target = sourceLink.target;
        }

        if (sourceLink.rel) {
            imageLink.rel = sourceLink.rel;
        }

        const watermarkWrapper = document.createElement('span');
        watermarkWrapper.className = 'wm-wrap no-watermark';

        const image = document.createElement('img');
        image.src = placeholderImage;
        image.alt = postTitle;
        image.className =
            'attachment-medium_large size-medium_large wp-post-image aiwl-img';
        image.loading = 'lazy';
        image.decoding = 'async';

        watermarkWrapper.appendChild(image);
        imageLink.appendChild(watermarkWrapper);

        /*
         * Insert the image link as the first child of .post-details.
         */
        postDetails.insertBefore(
            imageLink,
            postDetails.firstChild
        );
    }

    function processRelatedPosts(parent = document) {
        /*
         * Process the node itself when it is .post-details.
         */
        if (
            parent.nodeType === Node.ELEMENT_NODE &&
            parent.matches('.related-post .post-details')
        ) {
            addRelatedPostPlaceholder(parent);
        }

        /*
         * Process matching elements within the node.
         */
        if (parent.querySelectorAll) {
            parent
                .querySelectorAll('.related-post .post-details')
                .forEach(addRelatedPostPlaceholder);
        }
    }

    function initializeRelatedPostPlaceholders() {
        processRelatedPosts();

        /*
         * Support related posts added through AJAX or Load More.
         */
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    processRelatedPosts(node);
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            initializeRelatedPostPlaceholders
        );
    } else {
        initializeRelatedPostPlaceholders();
    }
})();



// Revised News Updates Carousel
jQuery(document).ready(function ($) {
  // Only run on News Update single pages
  if (!$("body").hasClass("single-news-updates")) return;

  if (typeof $.fn.flickity !== "function") return;

  $(".photo-carousel-component").each(function () {
    var $component = $(this);

    var $carousel = $component.find(".video-carousel");

    if (!$carousel.length) return;

    // Prevent double initialization
    if ($carousel.hasClass("flickity-enabled")) return;

    $carousel.flickity({
      cellAlign: "left",
      contain: true,
      prevNextButtons: true,
      pageDots: false,
      draggable: false,
    });

    var flkty = $carousel.data("flickity");

    var $navigation = $component.find(".carousel-navigation");
    var $buttons = $navigation.find(".carousel-buttons");
    var $status = $navigation.find(".carousel-status");

    function formatNumber(n) {
      return n < 10 ? "0" + n : n;
    }

    function updateStatus(index) {
      var total = flkty.slides.length;

      $status.text(
        formatNumber(index + 1) +
        " / " +
        formatNumber(total)
      );
    }

    updateStatus(flkty.selectedIndex);

    $carousel.on("change.flickity", function (event, index) {
      updateStatus(index);
    });

    // Move ONLY this carousel's buttons
    setTimeout(function () {

      var $prevButton = $carousel.find(".flickity-prev-next-button.previous");
      var $nextButton = $carousel.find(".flickity-prev-next-button.next");

      $buttons.empty().append($prevButton).append($nextButton);

      // Replace SVGs
      $prevButton.html(
        '<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>'
      );

      $nextButton.html(
        '<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>'
      );

    }, 100);

    // Modal
    var $modal = $component.find(".enterprise-modal");
    var $photo = $modal.find(".photo-container");

    $component.find(".carousel-thumbnail").on("click", function () {
      $photo
        .attr("src", $(this).data("full"))
        .attr("alt", $(this).attr("alt"));

      $modal.addClass("active").fadeIn();
    });

    function closeModal() {
      $modal.removeClass("active").fadeOut();
      $photo.attr("src", "").attr("alt", "");
    }

    $modal.find(".close-btn").on("click", closeModal);

    $modal.on("click", function (e) {
      if (e.target !== this) return;
      closeModal();
    });
  });
});

//AOS right whitespace fix
jQuery(function ($) {
    $('[data-aos]').each(function () {
        const $parent = $(this).parent();

        if ($parent.length) {
            $parent.addClass('aos-overflow-fix');
        }
    });
});


// Proper Noun detector

document.addEventListener('DOMContentLoaded', function () {
    const mobileQuery = window.matchMedia('(max-width: 575px)');
    const paragraphSelector = 'p';

    // Sections where the script should NOT run
    const excludedSelector = '#investorsInvestorRelationsSub, #ourBrandsDocs';


    const capitalizedSegment = String.raw`
        [\p{Lu}]
        [\p{L}\p{M}\p{N}']*
        (?:[-‐-‒–—][\p{Lu}\p{L}\p{M}\p{N}'’]+)*
        (?:
            \s*&\s*
            [\p{Lu}]
            [\p{L}\p{M}\p{N}'’]*
            (?:[-‐-‒–—][\p{Lu}\p{L}\p{M}\p{N}'’]+)*
        )*
    `.replace(/\s+/g, '');

    const connector = String.raw`
        (?:of|the|at|in|on|for|de|la)
    `.replace(/\s+/g, '');

    const properNounPattern = new RegExp(
        String.raw`\b(?:The\s+)?${capitalizedSegment}(?:\s+(?:(?:${connector})\s+)*${capitalizedSegment})+(?=\s|[.,!?;:)]|$)`,
        'gu'
    );

    /*
     * Detects individual hyphenated words:
     *
     * mixed-use
     * world-class
     * high-rise
     * Shangri-La
     */
    const hyphenatedWordPattern =
        /[\p{L}\p{M}\p{N}'’]+(?:[-‐-‒–—][\p{L}\p{M}\p{N}'’]+)+/gu;

    let resizeTimer;

    function isInsideProtectedInlineBlock(element, paragraph) {
        let current = element;

        while (current && current !== paragraph) {
            const inlineDisplay = current.style.display
                .trim()
                .toLowerCase();

            if (
                current.classList.contains('d-inline-block') ||
                current.classList.contains('js-proper-noun') ||
                current.classList.contains('js-no-break-word') ||
                inlineDisplay === 'inline-block'
            ) {
                return true;
            }

            current = current.parentElement;
        }

        return false;
    }

    function getAvailableWidth(element) {
        const styles = window.getComputedStyle(element);

        const paddingLeft =
            parseFloat(styles.paddingLeft) || 0;

        const paddingRight =
            parseFloat(styles.paddingRight) || 0;

        return element.clientWidth - paddingLeft - paddingRight;
    }

    function measureTextWidth(text, referenceElement) {
        const styles = window.getComputedStyle(referenceElement);
        const measurement = document.createElement('span');

        measurement.textContent = text;

        Object.assign(measurement.style, {
            position: 'fixed',
            top: '-99999px',
            left: '-99999px',
            display: 'inline-block',
            visibility: 'hidden',
            pointerEvents: 'none',
            whiteSpace: 'nowrap',

            fontFamily: styles.fontFamily,
            fontSize: styles.fontSize,
            fontWeight: styles.fontWeight,
            fontStyle: styles.fontStyle,
            fontStretch: styles.fontStretch,
            fontVariant: styles.fontVariant,
            lineHeight: styles.lineHeight,
            letterSpacing: styles.letterSpacing,
            textTransform: styles.textTransform,
            wordSpacing: styles.wordSpacing
        });

        document.body.appendChild(measurement);

        const width =
            measurement.getBoundingClientRect().width;

        measurement.remove();

        return width;
    }

    function removeGeneratedWrappers() {
        document
            .querySelectorAll(
                `${paragraphSelector} .js-proper-noun,
                 ${paragraphSelector} .js-no-break-word`
            )
            .forEach(function (span) {
                span.replaceWith(
                    document.createTextNode(span.textContent)
                );
            });

        document
            .querySelectorAll(paragraphSelector)
            .forEach(function (paragraph) {
                paragraph.normalize();
            });
    }

    function getValidTextNodes(container) {
        const walker = document.createTreeWalker(
            container,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode(node) {
                    const parent = node.parentElement;

                    if (
                        !parent ||
                        !node.nodeValue.trim()
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    if (
                        parent.closest(
                            'a, button, script, style, textarea, input, select, option, code, pre'
                        )
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    if (
                        isInsideProtectedInlineBlock(
                            parent,
                            container
                        )
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        const textNodes = [];

        while (walker.nextNode()) {
            textNodes.push(walker.currentNode);
        }

        return textNodes;
    }

    function wrapMatches(
        textNode,
        pattern,
        className,
        availableWidth
    ) {
        const text = textNode.nodeValue;
        const matches = Array.from(text.matchAll(pattern));

        if (!matches.length) {
            return;
        }

        const fragment = document.createDocumentFragment();
        let lastIndex = 0;

        matches.forEach(function (match) {
            const matchedText = match[0];
            const matchIndex = match.index;

            if (matchIndex > lastIndex) {
                fragment.appendChild(
                    document.createTextNode(
                        text.slice(lastIndex, matchIndex)
                    )
                );
            }

            const phraseWidth = measureTextWidth(
                matchedText,
                textNode.parentElement
            );

            /*
             * Keep it together only when it can fit
             * inside the paragraph.
             */
            if (phraseWidth <= availableWidth) {
                const span = document.createElement('span');

                span.className = className;
                span.textContent = matchedText;

                fragment.appendChild(span);
            } else {
                /*
                 * Yield and allow normal wrapping.
                 */
                fragment.appendChild(
                    document.createTextNode(matchedText)
                );
            }

            lastIndex = matchIndex + matchedText.length;
        });

        if (lastIndex < text.length) {
            fragment.appendChild(
                document.createTextNode(
                    text.slice(lastIndex)
                )
            );
        }

        textNode.replaceWith(fragment);
    }

    function applyProperNounWrapping() {
        removeGeneratedWrappers();

        if (!mobileQuery.matches) {
            return;
        }

        document
            .querySelectorAll(paragraphSelector)
          .forEach(function (paragraph) {

            // Whitelist: leave these sections untouched
            if (paragraph.closest(excludedSelector)) {
                return;
            }

            const availableWidth =
                    getAvailableWidth(paragraph);

                if (availableWidth <= 0) {
                    return;
                }

                /*
                 * First protect full proper-noun phrases.
                 */
                getValidTextNodes(paragraph).forEach(
                    function (textNode) {
                        wrapMatches(
                            textNode,
                            properNounPattern,
                            'js-proper-noun',
                            availableWidth
                        );
                    }
                );

                /*
                 * Then protect remaining individual
                 * hyphenated words.
                 */
                getValidTextNodes(paragraph).forEach(
                    function (textNode) {
                        wrapMatches(
                            textNode,
                            hyphenatedWordPattern,
                            'js-no-break-word',
                            availableWidth
                        );
                    }
                );
            });
    }

    applyProperNounWrapping();

    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(
            applyProperNounWrapping,
            150
        );
    });

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(
            applyProperNounWrapping
        );
    }
});



// Proper Noun - headings
document.addEventListener('DOMContentLoaded', function () {
    const headingSelector = 'h1, h2, h3';
    const mobileQuery = window.matchMedia('(max-width: 575px)');

    let resizeTimer;

    /**
     * Returns the usable content width of an element.
     */
    function getAvailableWidth(element) {
        const styles = window.getComputedStyle(element);

        const paddingLeft =
            parseFloat(styles.paddingLeft) || 0;

        const paddingRight =
            parseFloat(styles.paddingRight) || 0;

        return (
            element.clientWidth -
            paddingLeft -
            paddingRight
        );
    }

    /**
     * Measures text using the font styles of the
     * reference element.
     */
    function measureTextWidth(text, referenceElement) {
        const styles =
            window.getComputedStyle(referenceElement);

        const measurement =
            document.createElement('span');

        measurement.textContent = text;

        Object.assign(measurement.style, {
            position: 'fixed',
            top: '-99999px',
            left: '-99999px',
            display: 'inline-block',
            visibility: 'hidden',
            pointerEvents: 'none',
            whiteSpace: 'nowrap',

            fontFamily: styles.fontFamily,
            fontSize: styles.fontSize,
            fontWeight: styles.fontWeight,
            fontStyle: styles.fontStyle,
            fontStretch: styles.fontStretch,
            fontVariant: styles.fontVariant,
            lineHeight: styles.lineHeight,
            letterSpacing: styles.letterSpacing,
            textTransform: styles.textTransform,
            wordSpacing: styles.wordSpacing
        });

        document.body.appendChild(measurement);

        const width =
            measurement.getBoundingClientRect().width;

        measurement.remove();

        return width;
    }

    /**
     * Protects existing manual inline-block elements.
     *
     * Examples:
     * class="d-inline-block"
     * style="display: inline-block;"
     */
    function isInsideProtectedElement(element, heading) {
        let current = element;

        while (current && current !== heading) {
            const inlineStyle =
                current.style.display
                    .trim()
                    .toLowerCase();

            if (
                current.classList.contains(
                    'd-inline-block'
                ) ||
                current.classList.contains(
                    'js-heading-unbreakable'
                ) ||
                inlineStyle === 'inline-block'
            ) {
                return true;
            }

            current = current.parentElement;
        }

        return false;
    }

    /**
     * Checks whether the heading contains a manually
     * created inline-block element.
     */
    function hasProtectedElement(heading) {
        return Array.from(
            heading.querySelectorAll('*')
        ).some(function (element) {
            const inlineStyle =
                element.style.display
                    .trim()
                    .toLowerCase();

            return (
                element.classList.contains(
                    'd-inline-block'
                ) ||
                inlineStyle === 'inline-block'
            );
        });
    }

    /**
     * Removes only the changes generated by this script.
     */
    function resetHeadings() {
        document
            .querySelectorAll(headingSelector)
            .forEach(function (heading) {
                heading.classList.remove(
                    'js-heading-one-line'
                );

                heading
                    .querySelectorAll(
                        '.js-heading-unbreakable'
                    )
                    .forEach(function (span) {
                        span.replaceWith(
                            document.createTextNode(
                                span.textContent
                            )
                        );
                    });

                heading.normalize();
            });
    }

    /**
     * Wrap hyphenated or joined terms so they do not
     * split internally.
     *
     * Examples:
     * Shangri-La
     * P&T
     * P/T
     */
    function protectJoinedWords(heading, availableWidth) {
        const walker = document.createTreeWalker(
            heading,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode(node) {
                    const parent = node.parentElement;

                    if (
                        !parent ||
                        !node.nodeValue.trim()
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    if (
                        parent.closest(
                            'script, style, textarea, code, pre'
                        )
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    if (
                        isInsideProtectedElement(
                            parent,
                            heading
                        )
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        const textNodes = [];

        while (walker.nextNode()) {
            textNodes.push(walker.currentNode);
        }

        textNodes.forEach(function (textNode) {
            const parts =
                textNode.nodeValue.split(/(\s+)/);

            const fragment =
                document.createDocumentFragment();

            let wasChanged = false;

            parts.forEach(function (part) {
                const isWhitespace = /^\s+$/.test(part);

                /*
                 * Matches joined terms such as:
                 * Shangri-La
                 * P&T
                 * P/T
                 * Client–Focused
                 */
                const isJoinedWord =
                    /[-‐-‒–/&]/u.test(part);

                if (
                    !isWhitespace &&
                    isJoinedWord &&
                    measureTextWidth(
                        part,
                        textNode.parentElement
                    ) <= availableWidth
                ) {
                    const span =
                        document.createElement('span');

                    span.className =
                        'js-heading-unbreakable';

                    span.textContent = part;

                    fragment.appendChild(span);

                    wasChanged = true;
                } else {
                    fragment.appendChild(
                        document.createTextNode(part)
                    );
                }
            });

            if (wasChanged) {
                textNode.replaceWith(fragment);
            }
        });
    }

    function applyHeadingWrapping() {
        resetHeadings();

        if (!mobileQuery.matches) {
            return;
        }

        document
            .querySelectorAll(headingSelector)
            .forEach(function (heading) {
                const availableWidth =
                    getAvailableWidth(heading);

                if (availableWidth <= 0) {
                    return;
                }

                const headingText =
                    heading.textContent.trim();

                if (!headingText) {
                    return;
                }

                /*
                 * Keep the entire heading together when
                 * it comfortably fits inside its container.
                 */
                const fullHeadingWidth =
                    measureTextWidth(
                        headingText,
                        heading
                    );

                if (
                    !hasProtectedElement(heading) &&
                    fullHeadingWidth <=
                        availableWidth - 1
                ) {
                    heading.classList.add(
                        'js-heading-one-line'
                    );

                    return;
                }

                /*
                 * The full heading is too wide, so allow
                 * normal wrapping between words while
                 * protecting joined words such as
                 * "Shangri-La".
                 */
                protectJoinedWords(
                    heading,
                    availableWidth
                );
            });
    }

    applyHeadingWrapping();

    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(
            applyHeadingWrapping,
            150
        );
    });

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(
            applyHeadingWrapping
        );
    }
});


// font reduction
document.addEventListener('DOMContentLoaded', function () {
    const headingSelector = 'h2, h3';
    const tabletBreakpoint = 1199;

    /*
     * Original font size => amount to subtract
     *
     * 100px → 70px
     * 85px  → 70px
     * 75px  → 70px
     * 65px  → 50px
     */
    const fontSizeReductions = {
        100: 30,
        85: 15,
        75: 5,
        65: 15,
        32: 7,
        28: 3,
    };

    const originalInlineStyles = new WeakMap();
    let resizeTimer;

    function storeOriginalInlineStyle(element) {
        if (originalInlineStyles.has(element)) {
            return;
        }

        originalInlineStyles.set(element, {
            value: element.style.getPropertyValue('font-size'),
            priority: element.style.getPropertyPriority('font-size')
        });
    }

    function restoreOriginalInlineStyle(element) {
        const original = originalInlineStyles.get(element);

        if (!original) {
            element.style.removeProperty('font-size');
            return;
        }

        if (original.value) {
            element.style.setProperty(
                'font-size',
                original.value,
                original.priority
            );
        } else {
            element.style.removeProperty('font-size');
        }
    }

    function applyResponsiveHeadingSizes() {
        const headings = document.querySelectorAll(headingSelector);

        /*
         * Restore first so reductions never accumulate
         * after resizing.
         */
        headings.forEach(function (heading) {
            restoreOriginalInlineStyle(heading);
        });

        /*
         * Keep original desktop sizes above 1199px.
         */
        if (window.innerWidth > tabletBreakpoint) {
            return;
        }

        headings.forEach(function (heading) {
            storeOriginalInlineStyle(heading);

            const computedSize = parseFloat(
                window.getComputedStyle(heading).fontSize
            );

            if (!Number.isFinite(computedSize)) {
                return;
            }

            /*
             * Rounding allows computed values such as
             * 99.98px to be treated as 100px.
             */
            const matchedSize = Math.round(computedSize);
            const reduction = fontSizeReductions[matchedSize];

            /*
             * Sizes not listed in the configuration
             * remain completely unchanged.
             */
            if (typeof reduction === 'undefined') {
                return;
            }

            const reducedSize = computedSize - reduction;

            heading.style.setProperty(
                'font-size',
                `${reducedSize}px`,
                'important'
            );
        });
    }

    applyResponsiveHeadingSizes();

    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(
            applyResponsiveHeadingSizes,
            150
        );
    });

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(
            applyResponsiveHeadingSizes
        );
    }
});



// OneShangriLa Carousel

// jQuery(document).ready(function ($) {
//   // Initialize Flickity on the correct carousel

//   var $carousel = $("#residentialCarouselOneShangriLa .video-carousel");

//   var flickityInstance = $carousel.flickity({
//     cellAlign: "left",

//     contain: true,

//     prevNextButtons: true,

//     pageDots: false,

//     draggable: false,
//   });

//   // Move prev/next buttons to navigation container

//   setTimeout(function () {
//     var $prevButton = $carousel.find(".flickity-prev-next-button.previous");

//     var $nextButton = $carousel.find(".flickity-prev-next-button.next");

//     $("#residentialCarouselOneShangriLa .carousel-buttons")
//       .append($prevButton)
//       .append($nextButton);
//   }, 100);

//   // Slide counter

//   function updateStatus(index) {
//     var totalSlides = $carousel.flickity("getCellElements").length;

//     // Add leading zero for numbers less than 10

//     var current = index + 1 < 10 ? "0" + (index + 1) : index + 1;

//     var total = totalSlides < 10 ? "0" + totalSlides : totalSlides;

//     $("#residentialCarouselOneShangriLa .carousel-status").text(current + " / " + total);
//   }

//   updateStatus(0);

//   $carousel.on("change.flickity", function (event, index) {
//     updateStatus(index);
//   });

//   // Photo modal: open full image

//   $("#residentialCarouselOneShangriLa .carousel-thumbnail").on("click", function () {
//     var fullUrl = $(this).data("full"); // must exist

//     var altText = $(this).attr("alt");

//     $("#photo-container").attr("src", fullUrl).attr("alt", altText);

//     $("#photo-modal").addClass("active").fadeIn();
//   });

//   // Close modal

//   $(".close-btn, #photo-modal").on("click", function (e) {
//     if (e.target !== this) return;

//     $("#photo-modal").removeClass("active").fadeOut();

//     $("#photo-container").attr("src", "").attr("alt", "");
//   });

//   // Replace Flickity arrows with SVG

//   (function replaceArrows() {
//     const prev = $carousel[0].querySelector(
//       ".flickity-prev-next-button.previous",
//     );

//     const next = $carousel[0].querySelector(".flickity-prev-next-button.next");

//     if (!prev || !next) return false;

//     prev.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></svg>`;

//     next.innerHTML = `<svg width="41" height="11" viewBox="0 0 41 11"><g transform="translate(41, 11) rotate(180)"><path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/></g></svg>`;

//     return true;
//   })();
// });



// Reusable Residential Photo Carousels
jQuery(document).ready(function ($) {
  // Only run on Residential single pages
  if (!$("body").hasClass("single-residentials")) return;

  // Flickity must be available
  if (typeof $.fn.flickity !== "function") return;

  $("section.js-reusable-photo-carousel[id]").each(function () {
    var $section = $(this);
    var sectionId = $section.attr("id");

    var $carousel = $section.find(".video-carousel").first();

    if (!$carousel.length || !sectionId) return;

    /*
     * Prevent this reusable script from processing the same
     * carousel more than once.
     */
    if ($carousel.data("residentialCarouselReady")) return;

    /*
     * Based on the existing markup:
     *
     * section.js-reusable-photo-carousel
     * section.carousel-navigation
     * div.enterprise-modal
     */
    var $navigation = $section
      .nextAll(".carousel-navigation")
      .first();

    var $buttonsContainer = $navigation
      .find(".carousel-buttons")
      .first();

    var $status = $navigation
      .find(".carousel-status")
      .first();

    var $modal = $navigation
      .nextAll(".enterprise-modal, .photo-modal")
      .first();

    /*
     * Fallback in case the modal is not immediately after
     * the navigation section.
     */
    if (!$modal.length) {
      $modal = $section
        .nextAll(".enterprise-modal, .photo-modal")
        .first();
    }

    var $photoContainer = $modal
      .find(".photo-container")
      .first();

    /*
     * Initialize only when Flickity has not already been
     * initialized by another script.
     */
    if (!$carousel.hasClass("flickity-enabled")) {
      $carousel.flickity({
        cellAlign: "left",
        contain: true,
        prevNextButtons: true,
        pageDots: false,
        draggable: false,
      });
    }

    var flkty = $carousel.data("flickity");

    if (!flkty) return;

    $carousel.data("residentialCarouselReady", true);

    function formatNumber(number) {
      return number < 10 ? "0" + number : number;
    }

    function updateStatus(index) {
      if (!$status.length) return;

      var totalSlides = flkty.cells.length;

      $status.text(
        formatNumber(index + 1) +
          " / " +
          formatNumber(totalSlides),
      );
    }

    function replaceArrowIcons($prevButton, $nextButton) {
      if ($prevButton.length) {
        $prevButton.html(
          '<svg width="41" height="11" viewBox="0 0 41 11" aria-hidden="true">' +
            '<path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>' +
          "</svg>",
        );
      }

      if ($nextButton.length) {
        $nextButton.html(
          '<svg width="41" height="11" viewBox="0 0 41 11" aria-hidden="true">' +
            '<g transform="translate(41 11) rotate(180)">' +
              '<path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>' +
            "</g>" +
          "</svg>",
        );
      }
    }

    function moveNavigationButtons() {
      /*
       * Use the Flickity instance references. These continue
       * working even after the buttons have been moved outside
       * the original carousel element.
       */
      var $prevButton =
        flkty.prevButton && flkty.prevButton.element
          ? $(flkty.prevButton.element)
          : $carousel
              .find(".flickity-prev-next-button.previous")
              .first();

      var $nextButton =
        flkty.nextButton && flkty.nextButton.element
          ? $(flkty.nextButton.element)
          : $carousel
              .find(".flickity-prev-next-button.next")
              .first();

      if (
        $buttonsContainer.length &&
        $prevButton.length &&
        $nextButton.length
      ) {
        $buttonsContainer
          .empty()
          .append($prevButton)
          .append($nextButton);
      }

      replaceArrowIcons($prevButton, $nextButton);
    }

    /*
     * Move immediately, then retry after Flickity has finished
     * creating its controls.
     */
    moveNavigationButtons();

    setTimeout(function () {
      moveNavigationButtons();
    }, 100);

    // Initial counter
    updateStatus(flkty.selectedIndex || 0);

    // Counter change
    $carousel
      .off("change.flickity.residentialReusableCarousel")
      .on(
        "change.flickity.residentialReusableCarousel",
        function (event, index) {
          updateStatus(index);
        },
      );

    // Open the modal
    $section
      .off(
        "click.residentialReusableCarousel",
        ".carousel-thumbnail",
      )
      .on(
        "click.residentialReusableCarousel",
        ".carousel-thumbnail",
        function () {
          if (!$modal.length || !$photoContainer.length) return;

          var fullUrl =
            $(this).attr("data-full") ||
            $(this).attr("src");

          var altText = $(this).attr("alt") || "";

          if (!fullUrl) return;

          $photoContainer
            .attr("src", fullUrl)
            .attr("alt", altText);

          $modal
            .stop(true, true)
            .addClass("active")
            .fadeIn();
        },
      );

    function closeModal() {
      if (!$modal.length || !$photoContainer.length) return;

      $modal
        .stop(true, true)
        .removeClass("active")
        .fadeOut();

      $photoContainer
        .attr("src", "")
        .attr("alt", "");
    }

    // Close-button click
    $modal
      .find(".close-btn")
      .off("click.residentialReusableCarousel")
      .on("click.residentialReusableCarousel", function (event) {
        event.preventDefault();
        event.stopPropagation();

        closeModal();
      });

    // Modal-background click
    $modal
      .off("click.residentialReusableCarousel")
      .on("click.residentialReusableCarousel", function (event) {
        if (event.target !== this) return;

        closeModal();
      });
  });
});


// Card height control (skipped when .related-posts is display: flex, i.e. single column)
document.addEventListener('DOMContentLoaded', () => {
  function matchHeights() {
    // Group cards by their nearest .related-posts container
    const groups = new Map();

    document.querySelectorAll('.related-post .post-details').forEach(d => {
      const container = d.closest('.related-posts');
      if (!container) return;
      if (!groups.has(container)) groups.set(container, []);
      groups.get(container).push(d);
    });

    groups.forEach((details, container) => {
      details.forEach(d => (d.style.minHeight = ''));        // reset before measuring

      if (getComputedStyle(container).display === 'flex') return; // single column: natural heights

      const tallest = Math.max(...details.map(d => d.getBoundingClientRect().height));
      details.forEach(d => (d.style.minHeight = tallest + 'px'));
    });
  }

  window.matchCardHeights = matchHeights;                    // so other scripts (AJAX) can call it

  matchHeights();
  window.addEventListener('load', matchHeights);             // after images/fonts settle

  let t;
  window.addEventListener('resize', () => {
    clearTimeout(t);
    t = setTimeout(matchHeights, 100);
  });
});

// Authored by - blockquote
document.addEventListener('DOMContentLoaded', function () {
    const pattern = /\bauthored\s+by\b/i;

    document.querySelectorAll('blockquote').forEach(function (blockquote) {
        const walker = document.createTreeWalker(
            blockquote,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode(node) {
                    const parent = node.parentElement;

                    if (
                        !parent ||
                        !pattern.test(node.nodeValue) ||
                        parent.closest('.js-authored-by, script, style, code, pre')
                    ) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        const textNodes = [];
        while (walker.nextNode()) {
            textNodes.push(walker.currentNode);
        }

        textNodes.forEach(function (textNode) {
            // Skip if an earlier wrap already swallowed this node
            if (
                !textNode.isConnected ||
                textNode.parentElement.closest('.js-authored-by')
            ) {
                return;
            }

            const match = textNode.nodeValue.match(pattern);
            if (!match) return;

            const parent = textNode.parentElement;

            // From "authored by" to the end of its parent element
            const range = document.createRange();
            range.setStart(textNode, match.index);
            range.setEnd(parent, parent.childNodes.length);

            const span = document.createElement('span');
            span.className = 'js-authored-by';
            span.style.display = 'inline-block';

            span.appendChild(range.extractContents());
            range.insertNode(span);
        });
    });
});



// 37 Years - homepage watermark
(function () {
  const section = document.querySelector('.homepage-years.actual-watermark');
  if (!section) return;

  const card = section.querySelector('.years-container');
  if (!card) return;

  const CLASS = 'wm-top-right';
  const GAP   = 12; // how close the card can get before the watermark jumps

  function check() {
    // measure the watermark in its normal position
    section.classList.remove(CLASS);

    const cs = getComputedStyle(section, '::after');
    const s  = section.getBoundingClientRect();
    const c  = card.getBoundingClientRect();

    const wmW      = parseFloat(cs.width)  || 69;
    const wmH      = parseFloat(cs.height) || 24;
    const wmRight  = parseFloat(cs.right)  || 0;
    const wmBottom = parseFloat(cs.bottom) || 0;

    // watermark box in viewport coordinates
    const wmLeftX = s.right - wmRight - wmW;
    const wmTopY  = s.bottom - wmBottom - wmH;
    const wmBotY  = s.bottom - wmBottom;

    const overlapsVertically = c.bottom > wmTopY && c.top < wmBotY;
    const tooClose = c.right > wmLeftX - GAP;

    if (overlapsVertically && tooClose) section.classList.add(CLASS);
  }

  check();
  window.addEventListener('resize', check);
  window.addEventListener('load', check);
  if ('ResizeObserver' in window) {
    new ResizeObserver(check).observe(section);
    new ResizeObserver(check).observe(card);
  }
})();