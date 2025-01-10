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

            // Sembunyikan semua detail perusahaan
            if (detailElement) {
                if (index !== 2) {
                    detailElement.style.opacity = '0';
                    detailElement.style.transition = 'opacity 0.3s ease-in-out';
                    setTimeout(() => {
                        detailElement.style.display = 'none';
                    }, 500);

                 }

            }
        });


        this.carouselArray.forEach(el => {
            el.classList.remove('company-item-1');
            el.classList.remove('company-item-2');
            el.classList.remove('company-item-3');
            el.classList.remove('company-item-4');
            el.classList.remove('company-item-5');
        });

        this.carouselArray.slice(0, 5).forEach((el , i) => {
            el.classList.add(`company-item-${i+1}`);
            if (i === 2) { // Index ke-2 berarti item ke-3
                const detailElement = el.querySelector('.company-detail');
                if (detailElement) {
                    detailElement.style.display = 'block';
                    setTimeout(() => {
                        detailElement.style.opacity = '1';
                    }, 0);
            } }
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
exampleCarousel.updateCompany(); 


function togglePopup(popupId) {
    document.getElementById(popupId).classList.toggle("active");
  }
