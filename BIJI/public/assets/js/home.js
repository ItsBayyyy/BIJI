document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    const images = ['https://i.ibb.co.com/C7d9dZH/totoro.png', 'https://i.ibb.co.com/3WHdsn3/kakashi.png', 'https://i.ibb.co.com/qd4fKQp/totoro2.png', 'https://i.ibb.co.com/bbPQXN7/ponyo.png'];
  
    const heroImage = document.getElementById('hero-image');
    heroImage.src = images[3];
  
    function changeHeroContent() {
      heroImage.style.opacity = 0;
      heroImage.classList.add('fade-zoom-out');
      heroImage.src = images[currentIndex];
  
      setTimeout(function () {
        heroImage.style.opacity = 1;
        heroImage.classList.remove('fade-zoom-out');
      }, 1000);
  
      currentIndex = (currentIndex + 1) % images.length;
    }
  
    setInterval(changeHeroContent, 5000);
  });
  