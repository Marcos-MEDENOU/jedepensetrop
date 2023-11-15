
<script>
import Header from "../Front-end/Partials/Header.vue";
import Footer from "../Front-end/Partials/Footer.vue";
// import { reactive } from "vue";
// import { ref } from "vue";
// import heading2 from "../Components/heading2.vue";
// import paragraph from "../Components/paragraph.vue";
// import Links from "../Components/Links.vue";
// import heading1 from "../Components/heading1.vue";

export default {
    // layout: Footer,
    props: {
        valueDisplays: String,

        articles: {
            type: Array,
            default: () => [],
        },
        data: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            showFr: false,
            showCmr: false,
            showBj: false,
            showEthp: false,
            showRwd: false,
            showTg: false,
            ShowCartePays: true,
            innerHTML: "",
            secteurs: [
                "Banque / Assurance  ",
                "Télécom  ",
                "Médias  ",
                "Energie  ",
                "E-commerce  ",
                "Immobilier  ",
                "Santé / pharmaceutique  ",
                "Tourisme / loisirs  ",
                "Automobile  ",
                "Technologie ",
            ],
            pays: ["Paris", "Addis - Abbeba", "Cotonou", "Kigali", "Lome", "Yaounde"],
            intervals: [],
            imageSrcVierge: "/images/Fond_carte_vierge.png",
            imageSrcFrance: "/images/Fond_carte_France.png",
            imageSrcBenin: "/images/Fond_carte_Benin.png",
            imageSrcCamer: "/images/Fond_carte_Cameroun.png",
        };
    },

    components: {
        Footer,
        Header
        // heading2,
        // paragraph,
        // Links,
        // heading1,
    },

    methods: {
        h1regexdetect(data) {
            const regex = /<h1>(.*?)<\/h1>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
                console.log(h1Content);
            }

            return h1Content;
        },

        h2regexdetect(data) {
            const regex = /<h2>(.*?)<\/h2>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
            }

            return h1Content;
        },
        paragraregexdetect(data) {
            const regex = /<p>(.*?)<\/p>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
            }
            return h1Content;
        },

        balise_a_regexdetect(html) {
            const tempElement = document.createElement("div");
            tempElement.innerHTML = html;

            const anchorTags = Array.from(tempElement.getElementsByTagName("a")).map(
                (anchor) => anchor.outerHTML
            );
            // console.log(anchorTags);
            return anchorTags;
        },

        paragraph_regex_detect(data) {
            const regex = /<p\b[^>]*>(.*?)<\/p>/g;
            const matches = [...data.matchAll(regex)];

            const paragraphs = matches.map((match) => match[0]);
            console.log(paragraphs);
            return paragraphs;
        },

        parsedhtml(data) {
            const parser = new DOMParser();
            const html = parser.parseFromString(data, "text/html");
            return html.body.innerHTML;
        },

        img_src_regex_detect(data) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, "text/html");

            const imgTag = doc.querySelector("img");
            if (imgTag) {
                const srcAttribute = imgTag.getAttribute("src");
                return srcAttribute;
            }
        },

        text_format(data, id) {
            // Sélectionnez l'élément dans lequel vous voulez afficher le rendu HTML
            const container = document.getElementById(id);

            // Modifiez le contenu de l'élément container en utilisant innerHTML
            return (container.innerHTML = data);
        },

        setInnerHTML(html, id) {
            element = document.getElementById(id);
            element.innerHTML = html;
            Array.from(element.querySelectorAll("script")).forEach((oldScript) => {
                const newScript = document.createElement("script");
                Array.from(oldScript.attributes).forEach((attr) =>
                    newScript.setAttribute(attr.name, attr.value)
                );
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        },

        changeImage() {
            this.imageSrc = "/images/Fond_carte_pays.png";
        },
        resetImage() {
            this.imageSrc = "/images/Fond_carte_vierge.png";
        },
        slider(element, pays) {
            // console.log(pays);
            // console.log(element);
            document.querySelector(".carte").src = element;
            // document.querySelector(pays).style="overflow"
            // let TableauPays = [this.showBj, this.showCmr, this.showFr, this.showEthp, this.showRwd];
            let TableauPays = [
                "showBj",
                "showCmr",
                "showFr",
                "showEthp",
                "showRwd",
                "showTg",
            ];
            switch (pays) {
                case "showBj":
                    this.showBj = !this.showBj;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showCmr":
                    this.showCmr = !this.showCmr;
                    this.showBj = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showFr":
                    this.showFr = !this.showFr;
                    this.showCmr = false;
                    this.showBj = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showEthp":
                    this.showEthp = !this.showEthp;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showBj = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showRwd":
                    this.showRwd = !this.showRwd;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showBj = false;
                    this.showTg = false;
                    break;
                case "showTg":
                    this.showTg = !this.showTg;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showBj = false;
                    this.showRwd = false;
                    break;
            }
        },
    },

    mounted() {
        const contentWidth = this.$refs.content.offsetWidth;
        const containerWidth = this.$refs.container.offsetWidth;
        const animationDuration = (contentWidth / containerWidth) * 30;
        this.$refs.content.style.animationDuration = `${animationDuration}s`;
        // Récupérez la valeur de la propriété innerHTML de votre élément dans la console
        let valueDisplays = document.querySelectorAll(".num");

        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let interval = 10000;

            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            function count() {
                startValue++;
                valueDisplay.innerHTML = startValue;
                if (startValue == endValue) {
                    clearInterval(intervalId);
                }
            }
            let intervalId = setInterval(count, duration);
            setTimeout(function () {
                clearInterval(intervalId);
                valueDisplay.innerHTML = endValue;
            }, 8000);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                } else {
                    entry.target.classList.remove("show");
                }
            });
        });
        const hiddenElements = document.querySelectorAll(".absent");
        hiddenElements.forEach((el) => observer.observe(el));
    },
};
</script>

<template>

    <!-- <Header></Header> -->
    
    <!-- <Footer></Footer> -->
</template>






