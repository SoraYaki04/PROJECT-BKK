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


        this.carouselArray.forEach(el => {
            el.parentElement.querySelector('.company-detail').style.display = 'none';
            el.classList.remove('company-item-1');
            el.classList.remove('company-item-2');
            el.classList.remove('company-item-3');
            el.classList.remove('company-item-4');
            el.classList.remove('company-item-5');
        });

        this.carouselArray.slice(0, 5).forEach((el , i) => {
            el.classList.add(`company-item-${i+1}`);
            if (i === 2) {
                el.parentElement.querySelector('.company-detail').style.display = 'block';
            }
        })
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