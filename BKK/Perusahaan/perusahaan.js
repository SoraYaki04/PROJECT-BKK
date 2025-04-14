const companyContainer = document.querySelector('.company-container');
const companyControlsContainer = document.querySelector('.company-controls');
const companyControls =['previous', 'next'];
const companyItems = document.querySelectorAll('.company-item');

class Carousel {

    constructor(container, items, controls){
        this.carouselContainer = container;
        this.carouselControls = controls;
        this.carouselArray = [...items];
    }

    updateCompany() {

        this.carouselArray.forEach((el, index) => {
            const detailElement = el.querySelector('.company-detail');
        

            el.classList.forEach(cls => {
                if (cls.startsWith('company-item-')) {
                    el.classList.remove(cls);
                }
            });
        
            if (index < 5) {
                el.classList.remove('company-item-hidden');
                el.classList.add(`company-item-${index + 1}`);
            } else {
                el.classList.remove(`company-item-${index + 1}`);
                el.classList.add('company-item-hidden');
            }
        

            if (detailElement) {
                if (index === 2) {
                    detailElement.style.display = 'block';
                    requestAnimationFrame(() => {
                        detailElement.style.transition = 'opacity 0.5s ease-in-out';
                        detailElement.style.opacity = '1';
                    });
                } else {
                    detailElement.style.opacity = '0';
                    detailElement.style.transition = 'opacity 0.3s ease-in-out';
                    setTimeout(() => {
                        if (detailElement.style.opacity === '0') {
                            detailElement.style.display = 'none';
                        }
                    }, 500);
                }
            }
        });
        
    }
    

    setCurrentState(direction) {
        if (direction.className == 'company-controls-previous') {
            this.carouselArray.unshift(this.carouselArray.pop());
        } else {
            this.carouselArray.push(this.carouselArray.shift());
        }
        this.updateCompany();
    }

    setControls() {
        this.carouselControls.forEach(control => {
            companyControlsContainer.appendChild(document.createElement('button')).className = `company-controls-${control}`;
        });
    }

    useControls() {
        const triggers = [...companyControlsContainer.childNodes];
        triggers.forEach(control => {
            control.addEventListener('click', e => {
                e.preventDefault();
                this.setCurrentState(control);
            });
        });
        
    }
}

const exampleCarousel = new Carousel(companyContainer, companyItems, companyControls);
exampleCarousel.setControls();
exampleCarousel.useControls();
exampleCarousel.updateCompany(); 


function togglePopup(popupId) {
    document.getElementById(popupId).classList.toggle("active");
}
