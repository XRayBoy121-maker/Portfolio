// Initialize GSAP ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

// Fade in sections on scroll
gsap.utils.toArray('section').forEach(section => {
    gsap.set(section, { opacity: 0, y: 30 });
    
    ScrollTrigger.create({
        trigger: section,
        start: 'top 80%',
        onEnter: () => {
            gsap.to(section, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out'
            });
        }
    });
});

// Hero section animation
gsap.from('.hero .subtitle', {
    opacity: 0,
    y: 20,
    duration: 1,
    delay: 0.5
});

gsap.from('h1', {
    opacity: 0,
    y: 20,
    duration: 1,
    delay: 0.7
});

gsap.from('.hero p', {
    opacity: 0,
    y: 20,
    duration: 1,
    delay: 0.9
});

gsap.from('.cta-button', {
    opacity: 0,
    y: 20,
    duration: 1,
    delay: 1.1
});

// Skill items stagger animation
ScrollTrigger.create({
    trigger: '.skills-grid',
    start: 'top 80%',
    onEnter: () => {
        gsap.from('.skill-item', {
            opacity: 0,
            y: 30,
            duration: 0.5,
            stagger: 0.1
        });
    }
});

// Form handling
const contactForm = document.getElementById('contactForm');
const formMessage = document.getElementById('formMessage');

const showMessage = (message, type) => {
    formMessage.textContent = message;
    formMessage.className = `form-message ${type}`;
    setTimeout(() => {
        formMessage.className = 'form-message';
    }, 5000);
};

contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(contactForm);
    const button = contactForm.querySelector('button');
    const originalText = button.textContent;
    
    button.textContent = 'Sending...';
    button.disabled = true;

    try {
        const response = await fetch('process_form.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showMessage('Message sent successfully!', 'success');
            contactForm.reset();
        } else {
            showMessage(result.message || 'Error sending message', 'error');
        }
    } catch (error) {
        showMessage('Error sending message. Please try again later.', 'error');
        console.error('Error:', error);
    }

    button.textContent = originalText;
    button.disabled = false;
});
