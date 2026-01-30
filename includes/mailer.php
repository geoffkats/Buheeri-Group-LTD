<?php
/**
 * Email Configuration using PHPMailer with Gmail App Passwords
 * 
 * Setup Instructions:
 * 1. Enable 2-Step Verification on your Gmail account
 * 2. Go to https://myaccount.google.com/apppasswords
 * 3. Generate an App Password for "Mail"
 * 4. Update the credentials below
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require_once __DIR__ . '/../assets/vendor/phpmailer/Exception.php';
require_once __DIR__ . '/../assets/vendor/phpmailer/PHPMailer.php';
require_once __DIR__ . '/../assets/vendor/phpmailer/SMTP.php';

class Mailer {
    private $mail;
    
    // Email Configuration - UPDATE THESE VALUES
    private $smtp_host = 'smtp.gmail.com';
    private $smtp_port = 587;
    private $smtp_username = 'katogeoffreyg@gmail.com'; // Your Gmail address
    private $smtp_password = 'sekm mwhv mgjr tgbn'; // Your Gmail App Password (16 characters)
    private $from_email = 'katogeoffreyg@gmail.com';
    private $from_name = 'Buheeri Group U Ltd';
    
    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configure();
    }
    
    /**
     * Configure PHPMailer settings
     */
    private function configure() {
        try {
            // Server settings
            $this->mail->isSMTP();
            $this->mail->Host = $this->smtp_host;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->smtp_username;
            $this->mail->Password = $this->smtp_password;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = $this->smtp_port;
            
            // Default sender
            $this->mail->setFrom($this->from_email, $this->from_name);
            
            // Character set
            $this->mail->CharSet = 'UTF-8';
            
        } catch (Exception $e) {
            error_log("Mailer configuration error: " . $e->getMessage());
        }
    }
    
    /**
     * Send contact form notification
     */
    public function sendContactNotification($data) {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearReplyTos();
            
            // Recipients
            $this->mail->addAddress(COMPANY_EMAIL);
            $this->mail->addReplyTo($data['email'], $data['name']);
            
            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'New Contact Form Submission: ' . $data['subject'];
            
            $body = $this->getContactEmailTemplate($data);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Contact email error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
    
    /**
     * Send career application notification
     */
    public function sendCareerNotification($data, $cv_filename = null) {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearReplyTos();
            $this->mail->clearAttachments();
            
            // Recipients
            $this->mail->addAddress(COMPANY_EMAIL);
            $this->mail->addReplyTo($data['email'], $data['name']);
            
            // Attach CV if provided
            if ($cv_filename && file_exists('../uploads/' . $cv_filename)) {
                $this->mail->addAttachment('../uploads/' . $cv_filename);
            }
            
            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'New Job Application: ' . $data['position'];
            
            $body = $this->getCareerEmailTemplate($data, $cv_filename);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Career email error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
    
    /**
     * Contact form email template
     */
    private function getContactEmailTemplate($data) {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { 
                    font-family: "Segoe UI", Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    background: #f5f7fa;
                    padding: 20px;
                }
                .email-container { 
                    max-width: 600px; 
                    margin: 0 auto; 
                    background: #ffffff;
                    border: 3px solid #D4A017;
                }
                .header { 
                    background: #001973; 
                    color: white; 
                    padding: 30px 40px; 
                    text-align: center;
                    border-bottom: 3px solid #D4A017;
                }
                .header h1 {
                    font-size: 24px;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin: 0;
                }
                .header p {
                    margin: 10px 0 0 0;
                    font-size: 14px;
                    opacity: 0.9;
                }
                .content { 
                    padding: 40px;
                    background: #ffffff;
                }
                .notification-badge {
                    background: #D4A017;
                    color: #001973;
                    padding: 15px 20px;
                    text-align: center;
                    font-weight: 700;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin-bottom: 30px;
                }
                .field { 
                    margin-bottom: 25px;
                    padding-bottom: 20px;
                    border-bottom: 2px solid #f0f0f0;
                }
                .field:last-child {
                    border-bottom: none;
                }
                .label { 
                    font-weight: 700; 
                    color: #001973;
                    font-size: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 8px;
                }
                .value { 
                    margin-top: 8px;
                    font-size: 15px;
                    color: #333;
                    line-height: 1.6;
                }
                .message-box {
                    background: #f8f9fa;
                    padding: 20px;
                    border-left: 4px solid #001973;
                    margin-top: 10px;
                }
                .footer { 
                    background: #f8f9fa;
                    padding: 30px 40px; 
                    text-align: center;
                    border-top: 2px solid #e0e0e0;
                }
                .footer p { 
                    margin: 5px 0;
                    color: #666; 
                    font-size: 13px;
                }
                .security-badge {
                    margin-top: 20px;
                    padding: 15px;
                    background: #ffffff;
                    border: 2px solid #D4A017;
                    display: inline-block;
                }
                .security-badge strong {
                    color: #001973;
                    font-weight: 700;
                }
                .company-info {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    font-size: 12px;
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>Buheeri Group U Ltd</h1>
                    <p>New Contact Form Submission</p>
                </div>
                
                <div class="content">
                    <div class="notification-badge">
                        📧 New Message Received
                    </div>
                    
                    <div class="field">
                        <div class="label">👤 Full Name</div>
                        <div class="value">' . htmlspecialchars($data['name']) . '</div>
                    </div>
                    
                    <div class="field">
                        <div class="label">📧 Email Address</div>
                        <div class="value"><a href="mailto:' . htmlspecialchars($data['email']) . '" style="color: #001973; text-decoration: none;">' . htmlspecialchars($data['email']) . '</a></div>
                    </div>
                    
                    <div class="field">
                        <div class="label">📱 Phone Number</div>
                        <div class="value">' . htmlspecialchars($data['phone'] ?? 'Not provided') . '</div>
                    </div>
                    
                    <div class="field">
                        <div class="label">🏢 Division</div>
                        <div class="value">' . htmlspecialchars($data['division'] ?? 'General Inquiry') . '</div>
                    </div>
                    
                    <div class="field">
                        <div class="label">📋 Subject</div>
                        <div class="value"><strong>' . htmlspecialchars($data['subject']) . '</strong></div>
                    </div>
                    
                    <div class="field">
                        <div class="label">💬 Message</div>
                        <div class="message-box">' . nl2br(htmlspecialchars($data['message'])) . '</div>
                    </div>
                </div>
                
                <div class="footer">
                    <p style="font-size: 14px; color: #001973; font-weight: 600;">This email was sent from the Buheeri Group website contact form</p>
                    
                    <div class="security-badge">
                        🛡️ Security monitored by <strong>Synthilogic Enterprise</strong>
                    </div>
                    
                    <div class="company-info">
                        <p><strong>Buheeri Group U Ltd</strong></p>
                        <p>P.O. Box 300200, Intinda, Tororo, Uganda</p>
                        <p>Phone: +256 776 722 138 / +256 702 860 382</p>
                        <p>Email: buheeri.consults@gmail.com | www.buheeri.co.ug</p>
                        <p style="margin-top: 10px;">&copy; ' . date('Y') . ' Buheeri Group U Ltd. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ';
    }
    
    /**
     * Career application email template
     */
    private function getCareerEmailTemplate($data, $cv_filename) {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { 
                    font-family: "Segoe UI", Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    background: #f5f7fa;
                    padding: 20px;
                }
                .email-container { 
                    max-width: 600px; 
                    margin: 0 auto; 
                    background: #ffffff;
                    border: 3px solid #D4A017;
                }
                .header { 
                    background: #001973; 
                    color: white; 
                    padding: 30px 40px; 
                    text-align: center;
                    border-bottom: 3px solid #D4A017;
                }
                .header h1 {
                    font-size: 24px;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin: 0;
                }
                .header p {
                    margin: 10px 0 0 0;
                    font-size: 14px;
                    opacity: 0.9;
                }
                .content { 
                    padding: 40px;
                    background: #ffffff;
                }
                .notification-badge {
                    background: #28a745;
                    color: white;
                    padding: 15px 20px;
                    text-align: center;
                    font-weight: 700;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin-bottom: 30px;
                }
                .position-highlight {
                    background: #D4A017;
                    color: #001973;
                    padding: 20px;
                    text-align: center;
                    margin-bottom: 30px;
                }
                .position-highlight h2 {
                    font-size: 20px;
                    font-weight: 700;
                    text-transform: uppercase;
                    margin: 0;
                }
                .field { 
                    margin-bottom: 25px;
                    padding-bottom: 20px;
                    border-bottom: 2px solid #f0f0f0;
                }
                .field:last-child {
                    border-bottom: none;
                }
                .label { 
                    font-weight: 700; 
                    color: #001973;
                    font-size: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 8px;
                }
                .value { 
                    margin-top: 8px;
                    font-size: 15px;
                    color: #333;
                    line-height: 1.6;
                }
                .cover-letter-box {
                    background: #f8f9fa;
                    padding: 20px;
                    border-left: 4px solid #001973;
                    margin-top: 10px;
                }
                .cv-attachment {
                    background: #e8f5e9;
                    padding: 15px 20px;
                    border-left: 4px solid #28a745;
                    margin-top: 10px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .footer { 
                    background: #f8f9fa;
                    padding: 30px 40px; 
                    text-align: center;
                    border-top: 2px solid #e0e0e0;
                }
                .footer p { 
                    margin: 5px 0;
                    color: #666; 
                    font-size: 13px;
                }
                .security-badge {
                    margin-top: 20px;
                    padding: 15px;
                    background: #ffffff;
                    border: 2px solid #D4A017;
                    display: inline-block;
                }
                .security-badge strong {
                    color: #001973;
                    font-weight: 700;
                }
                .company-info {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    font-size: 12px;
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>Buheeri Group U Ltd</h1>
                    <p>New Job Application Received</p>
                </div>
                
                <div class="content">
                    <div class="notification-badge">
                        💼 New Application
                    </div>
                    
                    <div class="position-highlight">
                        <h2>📌 ' . htmlspecialchars($data['position']) . '</h2>
                    </div>
                    
                    <div class="field">
                        <div class="label">👤 Applicant Name</div>
                        <div class="value"><strong>' . htmlspecialchars($data['name']) . '</strong></div>
                    </div>
                    
                    <div class="field">
                        <div class="label">📧 Email Address</div>
                        <div class="value"><a href="mailto:' . htmlspecialchars($data['email']) . '" style="color: #001973; text-decoration: none;">' . htmlspecialchars($data['email']) . '</a></div>
                    </div>
                    
                    <div class="field">
                        <div class="label">📱 Phone Number</div>
                        <div class="value">' . htmlspecialchars($data['phone']) . '</div>
                    </div>
                    
                    ' . ($cv_filename ? '<div class="field">
                        <div class="label">📎 CV/Resume</div>
                        <div class="cv-attachment">
                            <span style="font-size: 24px;">📄</span>
                            <div>
                                <strong>Attached to this email</strong><br>
                                <span style="font-size: 13px; color: #666;">' . htmlspecialchars($cv_filename) . '</span>
                            </div>
                        </div>
                    </div>' : '') . '
                    
                    <div class="field">
                        <div class="label">✍️ Cover Letter</div>
                        <div class="cover-letter-box">' . nl2br(htmlspecialchars($data['cover_letter'])) . '</div>
                    </div>
                </div>
                
                <div class="footer">
                    <p style="font-size: 14px; color: #001973; font-weight: 600;">This email was sent from the Buheeri Group careers page</p>
                    
                    <div class="security-badge">
                        🛡️ Security monitored by <strong>Synthilogic Enterprise</strong>
                    </div>
                    
                    <div class="company-info">
                        <p><strong>Buheeri Group U Ltd</strong></p>
                        <p>P.O. Box 300200, Intinda, Tororo, Uganda</p>
                        <p>Phone: +256 776 722 138 / +256 702 860 382</p>
                        <p>Email: buheeri.consults@gmail.com | www.buheeri.co.ug</p>
                        <p style="margin-top: 10px;">&copy; ' . date('Y') . ' Buheeri Group U Ltd. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ';
    }
}
?>
