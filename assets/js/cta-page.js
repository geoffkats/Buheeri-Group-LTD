/**
 * CTA Page - Premium Interactive JavaScript
 * Buheeri Group U Ltd
 */

// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', () => {
  AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
    offset: 100
  });

  // Initialize all interactive features
  initHeroAnimations();
  initRippleEffects();
  initValueCards();
  initStatsCounters();
  initParallaxEffects();
  initTiltEffects();
  initScrollIndicator();
  initCTAButtons();
});

/**
 * Hero Section Animations
 */
function initHeroAnimations() {
  const heroSection = document.querySelector('.hero-cta');
  if (!heroSection) return;

  // Animated gradient background
  const gradientOverlay = document.querySelector('.gradient-overlay');
  if (gradientOverlay) {
    let hue = 210; // Start with blue
    setInterval(() => {
      hue = (hue + 0.5) % 360;
      gradientOverlay.style.background = `
        linear-gradient(135deg, 
          hsl(${hue}, 45%, 20%) 0%, 
          hsl(${(hue + 30) % 360}, 55%, 15%) 50%, 
          hsl(${(hue + 60) % 360}, 65%, 10%) 100%)
      `;
    }, 100);
  }

  // Animated particles
  createParticles();
}

/**
 * Create floating particles in hero background
 */
function createParticles() {
  const particlesContainer = document.querySelector('.animated-particles');
  if (!particlesContainer) return;

  const particleCount = 30;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.cssText = `
      position: absolute;
      width: ${Math.random() * 4 + 2}px;
      height: ${Math.random() * 4 + 2}px;
      background: rgba(212, 160, 23, ${Math.random() * 0.5 + 0.2});
      border-radius: 50%;
      left: ${Math.random() * 100}%;
      top: ${Math.random() * 100}%;
      animation: float ${Math.random() * 10 + 10}s infinite ease-in-out;
      animation-delay: ${Math.random() * 5}s;
    `;
    particlesContainer.appendChild(particle);
  }

  // Add keyframe animation for particles
  const style = document.createElement('style');
  style.textContent = `
    @keyframes float {
      0%, 100% {
        transform: translate(0, 0) scale(1);
        opacity: 0;
      }
      50% {
        transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(1.5);
        opacity: 1;
      }
    }
  `;
  document.head.appendChild(style);
}

/**
 * Ripple Effects on Buttons
 */
function initRippleEffects() {
  const buttons = document.querySelectorAll('.cta-btn, .final-cta-btn');
  
  buttons.forEach(button => {
    button.addEventListener('click', function(e) {
      const ripple = this.querySelector('.btn-ripple');
      if (!ripple) return;

      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      // Create ripple element
      const rippleEffect = document.createElement('span');
      rippleEffect.style.cssText = `
        position: absolute;
        left: ${x}px;
        top: ${y}px;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: translate(-50%, -50%);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
      `;
      
      ripple.appendChild(rippleEffect);

      // Remove ripple after animation
      setTimeout(() => {
        rippleEffect.remove();
      }, 600);
    });
  });

  // Add ripple animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes ripple-animation {
      to {
        width: 500px;
        height: 500px;
        opacity: 0;
      }
    }
    .btn-ripple {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      border-radius: inherit;
    }
  `;
  document.head.appendChild(style);
}

/**
 * Value Cards Hover Effects
 */
function initValueCards() {
  const cards = document.querySelectorAll('.value-card');
  
  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px) scale(1.05)';
      
      const underline = this.querySelector('.gold-underline');
      if (underline) {
        underline.style.width = '100%';
      }
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
      
      const underline = this.querySelector('.gold-underline');
      if (underline) {
        underline.style.width = '60px';
      }
    });
  });
}

/**
 * Animated Statistics Counters
 */
function initStatsCounters() {
  const statsSection = document.querySelector('.stats-section');
  if (!statsSection) return;

  const statNumbers = document.querySelectorAll('.stat-number');
  let hasAnimated = false;

  // Create Intersection Observer
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true;
        animateCounters();
      }
    });
  }, { threshold: 0.5 });

  observer.observe(statsSection);

  function animateCounters() {
    statNumbers.forEach(stat => {
      const target = parseInt(stat.getAttribute('data-target'));
      const duration = 2000; // 2 seconds
      const steps = 60;
      const increment = target / steps;
      let current = 0;
      let step = 0;

      const counter = setInterval(() => {
        step++;
        current += increment;
        
        if (step >= steps) {
          stat.textContent = target;
          clearInterval(counter);
        } else {
          stat.textContent = Math.floor(current);
        }
      }, duration / steps);
    });
  }
}

/**
 * Parallax Scroll Effects
 */
function initParallaxEffects() {
  const parallaxBg = document.querySelector('.parallax-bg');
  const floatingIcons = document.querySelectorAll('.floating-icon');

  if (!parallaxBg) return;

  window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const showcaseSection = document.querySelector('.divisions-showcase');
    
    if (showcaseSection) {
      const rect = showcaseSection.getBoundingClientRect();
      const offset = rect.top + scrolled;
      const relativeScroll = scrolled - offset;

      // Parallax background
      if (parallaxBg) {
        parallaxBg.style.transform = `translateY(${relativeScroll * 0.5}px)`;
      }

      // Floating icons parallax
      floatingIcons.forEach((icon, index) => {
        const speed = 0.3 + (index * 0.1);
        icon.style.transform = `translateY(${relativeScroll * speed}px) rotate(${relativeScroll * 0.05}deg)`;
      });
    }
  });
}

/**
 * 3D Tilt Effects on Division Cards
 */
function initTiltEffects() {
  const tiltCards = document.querySelectorAll('.card-tilt');

  tiltCards.forEach(card => {
    card.addEventListener('mousemove', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const rotateX = (y - centerY) / 10;
      const rotateY = (centerX - x) / 10;

      this.style.transform = `
        perspective(1000px) 
        rotateX(${rotateX}deg) 
        rotateY(${rotateY}deg) 
        scale3d(1.05, 1.05, 1.05)
      `;
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = `
        perspective(1000px) 
        rotateX(0deg) 
        rotateY(0deg) 
        scale3d(1, 1, 1)
      `;
    });

    // Smooth transition
    card.style.transition = 'transform 0.3s ease-out';
  });
}

/**
 * Scroll Indicator Animation
 */
function initScrollIndicator() {
  const scrollIndicator = document.querySelector('.scroll-indicator');
  if (!scrollIndicator) return;

  // Hide on scroll
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 100) {
      scrollIndicator.style.opacity = '0';
      scrollIndicator.style.pointerEvents = 'none';
    } else {
      scrollIndicator.style.opacity = '1';
      scrollIndicator.style.pointerEvents = 'auto';
    }
  });

  // Smooth scroll on click
  scrollIndicator.addEventListener('click', () => {
    const valueProps = document.querySelector('#value-props');
    if (valueProps) {
      valueProps.scrollIntoView({ behavior: 'smooth' });
    }
  });
}

/**
 * CTA Button Actions
 */
function initCTAButtons() {
  // Work With Us Button
  const workWithUsBtn = document.getElementById('workWithUsBtn');
  if (workWithUsBtn) {
    workWithUsBtn.addEventListener('click', () => {
      window.location.href = 'contact.html?intent=partnership';
    });
  }

  // Contact Team Button
  const contactTeamBtn = document.getElementById('contactTeamBtn');
  if (contactTeamBtn) {
    contactTeamBtn.addEventListener('click', () => {
      window.location.href = 'contact.html';
    });
  }

  // Start Project Button
  const startProjectBtn = document.getElementById('startProjectBtn');
  if (startProjectBtn) {
    startProjectBtn.addEventListener('click', () => {
      window.location.href = 'contact.html?intent=project';
    });
  }

  // Talk to Team Button
  const talkToTeamBtn = document.getElementById('talkToTeamBtn');
  if (talkToTeamBtn) {
    talkToTeamBtn.addEventListener('click', () => {
      window.location.href = 'contact.html';
    });
  }
}

/**
 * Glowing Border Animation for Final CTA
 */
(function initGlowingBorder() {
  const glowingBorder = document.querySelector('.glowing-border');
  if (!glowingBorder) return;

  let angle = 0;
  setInterval(() => {
    angle = (angle + 2) % 360;
    glowingBorder.style.background = `
      conic-gradient(
        from ${angle}deg,
        transparent,
        rgba(212, 160, 23, 0.6),
        transparent
      )
    `;
  }, 50);
})();

/**
 * Performance: Smooth Scroll Behavior
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

/**
 * Accessibility: Keyboard Navigation Support
 */
document.addEventListener('keydown', (e) => {
  // Allow keyboard users to activate buttons with Enter/Space
  if (e.key === 'Enter' || e.key === ' ') {
    if (document.activeElement.classList.contains('cta-btn') ||
        document.activeElement.classList.contains('final-cta-btn')) {
      e.preventDefault();
      document.activeElement.click();
    }
  }
});

// Log initialization
console.log('✨ CTA Page Interactive Features Loaded');
