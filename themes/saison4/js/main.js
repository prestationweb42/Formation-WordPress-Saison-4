jQuery(document).ready(function ($) {
    // console.log("toto");
    setTimeout(() => {
        $("h1").css({
            backgroundColor: "#89E4F5",
            color: "#fff",
            borderRadius: 10,
        });
    }, 2500);

    if (document.getElementById("carousel_01")) {
        var myCarousel = document.querySelector(".carousel");
        var carousel = new bootstrap.Carousel(myCarousel, {
            wrap: true,
        });
        //
        myCarousel.addEventListener("slide.bs.carousel", function (e) {
            // console.log(e.relatedTarget.find("[data-animation ^= 'animated']"));
            const elementsWithAnimationData = document.querySelectorAll(
                "[data-animation^='animate__animated']"
            );
            console.log(elementsWithAnimationData);
            doAnimations(elementsWithAnimationData);
        });
        //---------------------------------

        // Sélectionnez le premier élément avec la classe "slide" dans myCarousel
        const firstSlide = myCarousel.querySelector(
            ".carousel-item:first-of-type"
        );

        // Sélectionnez tous les éléments descendants avec l'attribut data-animation commençant par 'animate__animated' dans le premier slide
        const firstAnimationElements = firstSlide.querySelectorAll(
            "[data-animation^='animate__animated']"
        );

        // Appelez la fonction doAnimations avec les éléments trouvés
        doAnimations(firstAnimationElements);

        //---------------------------------
        function doAnimations(elems) {
            const animEndEv = "animationend";
            elems.forEach(function (elem) {
                const animationType = elem
                    .getAttribute("data-animation")
                    .trim();
                console.log(animationType);
                // Divise la chaîne en classes individuelles
                const animationClasses = animationType.split(" ");
                // Ajoute chaque classe individuellement
                animationClasses.forEach(function (cls) {
                    elem.classList.add(cls);
                });
                // Ajoute un écouteur d'événements pour l'événement "animationend"
                elem.addEventListener(animEndEv, function () {
                    // Supprime chaque classe d'animation une fois terminée
                    animationClasses.forEach(function (cls) {
                        elem.classList.remove(cls);
                    });
                    // Supprime également l'écouteur d'événements pour économiser des ressources
                    elem.removeEventListener(animEndEv, arguments.callee);
                });
            });
        }
    }
});
