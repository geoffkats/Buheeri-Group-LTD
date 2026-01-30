# Buheeri Group U Ltd - Corporate Website

This website has been transformed  into a comprehensive corporate website for **Buheeri Group U Ltd**, a diversified Ugandan enterprise.

## 🎨 Branding Changes

### Color Scheme
- **Primary Color**: Deep Navy (#0A1A2F)
- **Accent Color**: Gold (#D4A017)
- **Secondary Accent**: Emerald Green (#0F8A5F)
- **Background**: Cool Gray (#F5F7FA)
- **White**: #FFFFFF

### Typography
- **Headings**: Poppins (Google Fonts)
- **Body Text**: Inter (Google Fonts)

## 📁 Site Structure

### Main Pages
1. **Home** (`index.html`) - Hero section, divisions overview, why partner with us, featured projects, testimonials
2. **About Us** (`about.html`) - Company overview, mission/vision/values, leadership team, company timeline
3. **Projects** (`projects.html`) - Portfolio with category filtering
4. **Careers** (`careers.html`) - Job listings, company culture, application form
5. **Contact** (`contact.html`) - Contact form, map, division-specific contacts

### Division Pages
1. **General Supply** (`division-general-supply.html`)
2. **Construction & Engineering** (`division-construction.html`)
3. **Labour Recruitment & Training** (`division-labour.html`)
4. **Clearing & Forwarding / Logistics** (`division-logistics.html`)

Each division page includes:
- Division overview
- Services list
- Key strengths
- Call-to-action

## 🎯 Key Features

### Home Page
- Dynamic hero section with company mission
- 4 division cards with icons
- "Why Partner With Us" section (8 benefits)
- Featured projects carousel
- Client testimonials slider
- Statistics counter

### About Page
- Company overview with video placeholder
- Mission, Vision, Values cards
- Statistics section
- Leadership team profiles
- Interactive company timeline

### Projects Page
- Filterable project grid (All, Construction, Supply, Logistics, Recruitment)
- Project cards with images, categories, and descriptions
- JavaScript-powered filtering

### Careers Page
- Company culture highlights
- Current job openings with metadata
- Application form with file upload
- Responsive design

### Contact Page
- Google Maps integration
- Contact form with division selection
- Business hours
- Division-specific contact information

## 🔧 Technical Details

### CSS Structure
- Custom color variables in `:root`
- Responsive design (mobile-first)
- Component-based styling
- Smooth animations with AOS library

### JavaScript Features
- Mobile navigation toggle
- Project filtering
- Smooth scroll
- Form validation
- Swiper sliders for testimonials

### Dependencies
- Bootstrap 5.3.3
- Bootstrap Icons
- AOS (Animate On Scroll)
- Font Awesome
- GLightbox
- Swiper
- PureCounter

## 🚀 Future Integration Ready

The codebase is structured for easy migration to:

### Laravel (Blade Components)
- Clean HTML structure
- Reusable sections
- Form actions ready for backend
- Component-friendly markup

### Next.js (React Components)
- Semantic HTML
- Clear component boundaries
- Props-ready structure
- SEO-friendly markup

## 📝 Content Guidelines

### Images to Replace
- `assets/img/hero-img.svg` - Company hero illustration
- `assets/img/about.jpg` - About page image
- `assets/img/team/team-*.jpg` - Leadership photos
- `assets/img/service-*.jpg` - Project images
- `assets/img/features-*.jpg` - Feature images
- `assets/img/testimonials/testimonials-*.jpg` - Client photos

### Contact Information to Update
- Address: Plot 123, Kampala Road, Kampala, Uganda
- Phone: +256 700 123 456
- Email: info@buheerigroup.co.ug
- Social media links in footer

### Forms Configuration
Update form action URLs in:
- `contact.html` - Contact form
- `careers.html` - Application form
- Division pages - Quote request forms

## 🎨 Customization

### Colors
Edit CSS variables in `assets/css/main.css`:
```css
:root {
  --heading-color: #0A1A2F;
  --accent-color: #D4A017;
  --accent-secondary: #0F8A5F;
}
```

### Navigation
Update navigation in header section of each HTML file.

### Footer
Update footer content in each HTML file (consistent across all pages).

## 📱 Responsive Design

- Mobile-first approach
- Breakpoints: 576px, 768px, 992px, 1200px
- Touch-friendly navigation
- Optimized images

## ✅ Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## 📄 License

Based on BootstrapMade Logis template.
Customized for Buheeri Group U Ltd.

## 🔗 Links

- Original Template: [BootstrapMade Logis](https://bootstrapmade.com/logis-bootstrap-logistics-website-template/)
- Bootstrap: [v5.3.3](https://getbootstrap.com/)
- Font Awesome: [Free Icons](https://fontawesome.com/)

---

**Note**: This is a static HTML template. For full functionality, integrate with a backend system (Laravel, Node.js, etc.) for form processing, database connectivity, and dynamic content management.
