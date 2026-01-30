# Buheeri Group Admin Dashboard

Professional corporate admin dashboard for managing Buheeri Group U Ltd website content.

## Features

- **Dashboard Overview**: Real-time statistics and recent activity
- **Contact Management**: View and manage contact form submissions
- **Career Applications**: Review and manage job applications
- **Project Management**: Add, edit, and delete featured projects
- **Professional Design**: Clean, corporate aesthetic matching the main website

## Access Information

### Default Login Credentials
- **URL**: `http://localhost/Logis/admin/`
- **Username**: `admin`
- **Password**: `buheeri2024`

**⚠️ IMPORTANT**: Change the default password immediately after first login!

## Security

### Changing Admin Password

Edit `admin/login.php` and update these lines:

```php
$admin_username = 'admin';
$admin_password = 'your_new_secure_password';
```

### Recommended Security Measures

1. **Change Default Credentials**: Use a strong, unique password
2. **Restrict Access**: Use `.htaccess` to limit admin folder access by IP
3. **Enable HTTPS**: Always use SSL/TLS in production
4. **Regular Backups**: Backup database regularly
5. **Update Regularly**: Keep all software up to date

## File Structure

```
admin/
├── assets/
│   ├── css/
│   │   └── admin.css          # Admin dashboard styles
│   └── js/
│       └── admin.js           # Admin dashboard scripts
├── includes/
│   ├── sidebar.php            # Navigation sidebar
│   ├── topbar.php             # Top navigation bar
│   └── footer.php             # Footer component
├── index.php                  # Dashboard home
├── login.php                  # Login page
├── logout.php                 # Logout handler
├── contacts.php               # Contact management (to be created)
├── careers.php                # Career applications (to be created)
├── projects.php               # Project management (to be created)
└── settings.php               # Settings page (to be created)
```

## Database Tables

The admin dashboard manages these tables:

- `contact_submissions` - Contact form submissions
- `career_applications` - Job applications
- `projects` - Featured projects
- `testimonials` - Client testimonials

## Features Overview

### Dashboard
- Total contacts count
- Total career applications
- Total featured projects
- Recent activity feed
- Quick access links

### Contact Management
- View all contact submissions
- Search and filter contacts
- View detailed contact information
- Delete contacts
- Export to CSV (planned)

### Career Applications
- View all job applications
- Filter by position
- View applicant details
- Download CVs
- Delete applications

### Project Management
- Add new projects
- Edit existing projects
- Upload project images
- Set project status (active/inactive)
- Delete projects
- Categorize by division

## Design Philosophy

The admin dashboard follows the same professional corporate design as the main website:

- **Colors**: Navy blue (#001973), Gold (#D4A017)
- **Typography**: Clean, professional fonts
- **Layout**: Square borders, no rounded corners
- **Interactions**: Minimal, purposeful animations
- **Responsive**: Works on all devices

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Technical Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Modern web browser
- JavaScript enabled

## Support

For technical support or questions:
- **Email**: buheeri.consults@gmail.com
- **Phone**: +256 776 722 138

---

**Version**: 1.0  
**Last Updated**: January 2025  
**Developed for**: Buheeri Group U Ltd
