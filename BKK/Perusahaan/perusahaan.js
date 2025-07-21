const companyContainer = document.querySelector('.company-container');
const companyControlsContainer = document.querySelector('.company-controls');
const companyControls = ['previous', 'next'];
const companyItems = document.querySelectorAll('.company-item');

class Carousel {

    constructor(container, items, controls){
        this.carouselContainer = container;
        this.carouselControls = controls;
        this.carouselArray = [...items];
        this.isTransitioning = false;
        this.controlButtons = [];
    }

    updateCompany() {
        this.carouselArray.forEach((el, index) => {
            const detailElement = el.querySelector('.company-detail');

            if (detailElement && index !== 2) {
                detailElement.style.opacity = '0';
                detailElement.style.transition = 'opacity 0.3s ease-in-out';
                setTimeout(() => {
                    detailElement.style.display = 'none';
                }, 500);
            }
        });

        this.carouselArray.forEach(el => {
            el.classList.remove(
                'company-item-1',
                'company-item-2',
                'company-item-3',
                'company-item-4',
                'company-item-5'
            );
        });

        this.carouselArray.slice(0, 5).forEach((el , i) => {
            el.classList.add(`company-item-${i+1}`);

            if (i === 2) {
                const detailElement = el.querySelector('.company-detail');
                if (detailElement) {
                    detailElement.style.display = 'block';
                    setTimeout(() => {
                        detailElement.style.opacity = '1';
                    }, 0);
                }
            }
        });
    }

    setCurrentState(direction) {
        if (this.isTransitioning) return;
        this.isTransitioning = true;

        this.controlButtons.forEach(btn => btn.disabled = true);

        if (direction.className === 'company-controls-previous') {
            this.carouselArray.unshift(this.carouselArray.pop());
        } else {
            this.carouselArray.push(this.carouselArray.shift());
        }

        this.updateCompany();

        setTimeout(() => {
            this.isTransitioning = false;
            this.controlButtons.forEach(btn => btn.disabled = false);
        }, 600);
    }

    setControls() {
        this.carouselControls.forEach(control => {
            const button = document.createElement('button');
            button.className = `company-controls-${control}`;
            button.innerHTML = ''; // ❌ Tidak ada teks atau ikon
            companyControlsContainer.appendChild(button);
        });
    }

    useControls() {
        const triggers = [...companyControlsContainer.childNodes];
        this.controlButtons = triggers;

        triggers.forEach(control => {
            control.addEventListener('click', e => {
                e.preventDefault();
                if (!this.isTransitioning) {
                    this.setCurrentState(control);
                }
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
