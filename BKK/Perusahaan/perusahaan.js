document.addEventListener('DOMContentLoaded', () => {
  const companyContainer = document.querySelector('.company-container');
  const companyControlsContainer = document.querySelector('.company-controls');
  const companyControls = ['previous', 'next'];
  const companyItems = document.querySelectorAll('.company-item');
  companyItems.forEach((item, index) => {
    setTimeout(() => {
      item.classList.add("show");
    }, index * 100); 
  });

  if (!companyContainer || companyItems.length < 5) return;

  class Carousel {
    constructor(container, items, controls) {
      this.carouselContainer = container;
      this.carouselControls = controls;
      this.carouselArray = [...items];
      this.isTransitioning = false;
      this.controlButtons = [];
      this.autoPlayInterval = null;

      // ! acak sekali di awal dengan Fisher–Yates
      this.shuffleItems();

      // ! ambil 5 item pertama setelah shuffle
      this.carouselArray = this.carouselArray.slice(0, 5);

      this.setControls();
      this.useControls();
      this.updateCompany();
      this.startAutoPlay(3000);
    }

    // ! Fisher–Yates shuffle
    shuffleItems() {
      for (let i = this.carouselArray.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [this.carouselArray[i], this.carouselArray[j]] = [this.carouselArray[j], this.carouselArray[i]];
      }
    }

    updateCompany() {
      // ! reset semua item (bukan hanya 5)
      document.querySelectorAll('.company-item').forEach(el => {
        el.classList.remove(
          'company-item-1', 'company-item-2', 'company-item-3', 'company-item-4', 'company-item-5'
        );
        const detail = el.querySelector('.company-detail');
        if (detail) {
          detail.style.opacity = '0';
          detail.style.display = 'none';
        }
        el.style.display = 'none';
      });

      // ! tampilkan hanya 5 dari array aktif
      this.carouselArray.forEach((el, i) => {
        el.classList.add(`company-item-${i+1}`);
        el.style.display = '';

        if (i === 2) { // ! item tengah
          const detail = el.querySelector('.company-detail');
          if (detail) {
            detail.style.display = 'block';
            requestAnimationFrame(() => {
              detail.style.opacity = '1';
            });
          }
        }
      });
    }


    setCurrentState(direction) {
      if (this.isTransitioning) return;
      this.isTransitioning = true;

      this.controlButtons.forEach(btn => btn.disabled = true);

      if (direction.classList.contains('company-controls-previous')) {
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
      // ! bersihkan jika sudah ada
      companyControlsContainer.innerHTML = '';

      this.carouselControls.forEach(control => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = `company-controls-${control}`;
        button.setAttribute('aria-label', control);
        companyControlsContainer.appendChild(button);
      });
    }

    useControls() {
      const triggers = [...companyControlsContainer.children];
      this.controlButtons = triggers;

      triggers.forEach(control => {
        control.addEventListener('click', e => {
          e.preventDefault();
          if (!this.isTransitioning) {
            this.setCurrentState(control);
          }
        });
      });

      // ! pause saat hover
      this.carouselContainer.addEventListener('mouseenter', () => this.stopAutoPlay());
      this.carouselContainer.addEventListener('mouseleave', () => this.startAutoPlay());
    }

    startAutoPlay(interval = 5000) {
      this.stopAutoPlay();
      this.autoPlayInterval = setInterval(() => {
        if (!this.isTransitioning) {
          this.setCurrentState(
            document.querySelector('.company-controls-next')
          );
        }
      }, interval);
    }

    stopAutoPlay() {
      if (this.autoPlayInterval) clearInterval(this.autoPlayInterval);
    }
  }

  new Carousel(companyContainer, companyItems, companyControls);
});


function togglePopup(popupId) {
  document.getElementById(popupId).classList.toggle("active");
}