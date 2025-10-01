<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jobsplit @yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/JobSplit fav icon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @stack('styles')
    @livewireStyles 

    <style>
              /* --- 1. TOGGLE SWITCH KI STYLING --- */
.theme-switch-wrapper {
    display: flex;
    align-items: center;
}
.theme-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}
.theme-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}
.slider.round {
    border-radius: 34px;
}
.slider::before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider {
    background-color: #14b8a6; /* Teal Green */
}
input:checked + .slider::before {
    transform: translateX(24px);
}

        /* --- DASHBOARD KE LIYE MUKAMMAL DARK THEME STYLES --- */

/* === General Dashboard Layout === */
body.dark-mode {
    --primary-color: #7A5CFA;
    --background-color: #121212; /* Dark background */
    --container-bg: #1e1e1e; /* Card/container background */
    --border-color: #2c2c2c;
    --text-primary: #e0e0e0; /* Light text */
    --text-secondary: #888888;
    --message-sent-bg: linear-gradient(135deg, #7A5CFA, #5a3ecf);
    --message-received-bg: #333333;
}

body.dark-mode #page-content-wrapper {
    background-color: var(--background-color);
}

/* === Chat Interface === */
body.dark-mode .search-box {
    background-color: #2c2c2c;
    border-color: #444;
    color: var(--text-primary);
}
body.dark-mode .users-list li:hover {
    background-color: #252525;
}
body.dark-mode .users-list li.active {
    background-color: #2a2a3a;
}
body.dark-mode .messages {
    background-color: #181818;
}
body.dark-mode .message-form input {
    background: #2c2c2c;
    color: var(--text-primary);
    border: 1px solid #444;
}

/* === Profile Modal === */
body.dark-mode .profile-modal-card {
    background-color: #1e1e1e;
}
body.dark-mode .profile-modal-header,
body.dark-mode .profile-detail-item {
    border-color: #2c2c2c;
}
body.dark-mode .profile-name,
body.dark-mode .profile-detail-item p {
    color: #ffffff;
}
body.dark-mode .profile-email,
body.dark-mode .profile-detail-item strong {
    color: #888888;
}
body.dark-mode .profile-modal-footer button {
    background-color: #333333;
    color: #e0e0e0;
    border-color: #444;
}
body.dark-mode .profile-modal-footer button:hover {
    background-color: #444;
    border-color: #555;
}

/* === Mobile Menus (Sidebar, etc.) === */
body.dark-mode .menu_mobile {
    background-color: #1e1e1e;
    box-shadow: -2px 0 15px rgba(0, 0, 0, 0.2);
}
body.dark-mode .menu_mobile_close {
    background: #333;
    color: #fff;
}
body.dark-mode .nav_mobile_list li a,
body.dark-mode .mobile-dropdown-link {
    color: #e0e0e0;
    border-color: #2c2c2c;
}
body.dark-mode .mobile-dropdown-content {
    background-color: #252525;
}

/* === Sidebar Toggle Button for Mobile === */
body.dark-mode .sidebar-toggle-btn {
    background-color: #1e1e1e;
    border-color: #2c2c2c;
    color: #e0e0e0;
}

/* --- DASHBOARD PAGE KE LIYE DARK MODE CSS (JUGAR METHOD) --- */

/* Main content area ka background */
body.dark-mode .bg-surface {
    background-color: #111827; /* Dark Blue-Gray */
}

/* Sidebar toggle button ka text */
body.dark-mode .text-gray-600 {
    color: #cbd5e1; /* Light Gray */
}

/* Page ka main title ("Dashboard") */
body.dark-mode .heading4 {
    color: #ffffff;
}

/* Counter cards aur Graph container ka background */
body.dark-mode .bg-white {
    background-color: #1f2937; /* Darker card background */
    border: 1px solid #374151;
}

/* Cards ke andar ka secondary text (e.g., "Jobs Posted") */
body.dark-mode .text-secondary {
    color: #94a3b8; /* Lighter secondary text */
}

/* Graph container ka title */
body.dark-mode .heading5 {
    color: #ffffff;
}

/* Graph ke filter buttons ka text */
body.dark-mode .button_time {
    color: #94a3b8;
}

/* Graph ki lines aur text (ApexCharts ke liye) */
body.dark-mode .apexcharts-xaxis-label,
body.dark-mode .apexcharts-yaxis-label {
    fill: #94a3b8;
}
body.dark-mode .apexcharts-tooltip-title,
body.dark-mode .apexcharts-tooltip-text {
    color: #111827; /* Tooltip ke andar text dark hi rahega kyunke tooltip light hai */
}
body.dark-mode .apexcharts-gridline {
    stroke: #374151;
}

/* --- DARK MODE JUGAR (TAILWIND OVERRIDES) --- */

/* Backgrounds */
.dark-mode .bg-white { background-color: #1f2937 !important; }
.dark-mode .bg-gray-50 { background-color: #111827 !important; }
.dark-mode .bg-gray-100 { background-color: #374151 !important; }
.dark-mode .bg-gray-200 { background-color: #4b5563 !important; }

/* Text Colors */
.dark-mode .text-black,
.dark-mode .text-gray-900,
.dark-mode .text-gray-800,
.dark-mode .text-gray-700 {
    color: #f9fafb !important;
}

.dark-mode .text-gray-600,
.dark-mode .text-gray-500 {
    color: #d1d5db !important;
}

/* Border Colors */
.dark-mode .border-gray-200,
.dark-mode .border-gray-300 {
    border-color: #4b5563 !important;
}
/* --- CHAT MESSAGES TEXT KE LIYE DARK MODE FIX --- */

/* Received message bubble ka text color */
body.dark-mode .message-received {
    color: #e0e0e0; /* Light gray/white text */
}

/* Header mein user ka naam (just in case) */
body.dark-mode .chat-window .header .user-info .name {
    color: #ffffff;
}

/* Conversation list mein user ka naam (just in case) */
body.dark-mode .users-list .user-info .name {
    color: #e0e0e0;
}
/* --- CHAT MESSAGES TEXT KE LIYE FINAL DARK MODE FIX --- */

/* Yeh rule sent aur received, dono bubbles ke text par apply hogi */
body.dark-mode .message-bubble {
    color: #e0e0e0 !important; /* Light gray/white text */
}

/* Sent messages ka text pehle se white hai, lekin yeh rule usay confirm karegi */
body.dark-mode .message-sent {
    color: #ffffff !important; 
}
/* --- JOB APPLICANTS PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("Job Applicants") */
body.dark-mode .text-3xl.font-bold {
    color: #ffffff;
}

/* Main card ka background jahan jobs list hain */
body.dark-mode .bg-white {
    background-color: #1f2937 !important; /* Darker card bg */
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Har job item ke darmiyan wali border line */
body.dark-mode .border-b {
    border-bottom-color: #374151 !important;
}

/* Job ka title */
body.dark-mode .text-gray-800 {
    color: #ffffff !important;
}

/* Job ki secondary info (location, date, etc.) */
body.dark-mode .text-gray-500 {
    color: #9ca3af !important;
}

/* "No jobs yet" wala message */
body.dark-mode .p-6.text-center.text-gray-500 {
    color: #9ca3af !important;
}

/* "View Applicants" button ka text (just in case) */
body.dark-mode .button-main {
    color: #ffffff !important;
}


/* --- Pagination Ki Styling (Bohat Zaroori) --- */

/* Default pagination links (1, 2, 3...) */
body.dark-mode .pagination .page-item:not(.active) .page-link {
    background-color: #374151 !important;
    color: #d1d5db !important;
    border-color: #4b5563 !important;
}

/* Links par hover karne par */
body.dark-mode .pagination .page-item:not(.active) .page-link:hover {
    background-color: #4b5563 !important;
}

/* Active page ka link (current page) */
body.dark-mode .pagination .page-item.active .page-link {
    background-color: #14b8a6 !important; /* Teal Green */
    border-color: #14b8a6 !important;
    color: #ffffff !important;
}

/* Disabled links (e.g., prev/next arrows jab available na hon) */
body.dark-mode .pagination .page-item.disabled .page-link {
    background-color: #1f2937 !important;
    color: #6b7280 !important;
    border-color: #374151 !importan
}
/* --- JOB APPLICANTS DETAIL PAGE KE LIYE DARK MODE CSS --- */

/* "Back to Jobs" link */
body.dark-mode .text-blue-600 {
    color: #38bdf8 !important; /* Lighter Blue */
}
body.dark-mode .text-blue-600:hover {
    color: #7dd3fc !important;
}

/* Page title mein job ka naam */
body.dark-mode .text-gray-700 {
    color: #e5e7eb !important;
}

/* Applicant card ka background */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Applicant ka naam */
body.dark-mode .text-lg.font-bold {
    color: #ffffff !important;
}

/* Applicant ki description */
body.dark-mode .text-gray-600 {
    color: #9ca3af !important;
}

/* Bid amount (yeh pehle se green hai, a-chha lagega) */
/* Status (yeh pehle se colored hai, a-chha lagega) */

/* Border line in card footer */
body.dark-mode .border-t {
    border-top-color: #374151 !important;
}

/* "Approved" tag */
body.dark-mode span[style*="background-color: #2ecc71"] {
    background-color: #16a34a !important; /* Thora sa dark green */
    color: #ffffff !important;
}

/* "Feedback Submitted" tag */
body.dark-mode .feedback-submitted-tag {
    background-color: #4b5563 !important;
    color: #e5e7eb !important;
}

/* Buttons (Feedback, Chat, Approve) */
body.dark-mode .btn-feedback,
body.dark-mode .btn-chat {
    background-color: #374151 !important;
    color: #ffffff !important;
    border: 1px solid #4b5563 !important;
}
body.dark-mode .btn-feedback:hover,
body.dark-mode .btn-chat:hover {
    background-color: #4b5563 !important;
}
body.dark-mode .button-main {
    color: #ffffff !important; /* Approve button text */
}

/* "No applications" wala message */
body.dark-mode .p-6.text-center.text-gray-500 {
    color: #9ca3af !important;
}
/* --- JOB APPLICANTS PAGE (FIX for Bid & Status) --- */

/* Bid Amount ka text */
body.dark-mode .text-green-600 {
    color: #ffffff !important;
}

/* Status tag ka text (e.g., pending, approved) */
body.dark-mode .text-right .text-sm.capitalize {
    color: #f0f0f0 !important; /* Thora sa off-white */
    font-weight: 600; /* Thora sa bold */
}
/* --- MY JOBS PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("My Jobs") */
body.dark-mode h4.heading4[style*="color: #1b4cecff"] {
    color: #818cf8 !important; /* Lighter, less intense blue */
}

/* Main card ka background jahan jobs ki table hai */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Table header ka background ("POSTED JOBS") */
body.dark-mode .list_category {
    border-bottom-color: #374151 !important;
}
body.dark-mode .list_category h1 {
    color: #ffffff !important;
}

/* Table header text (th) */
body.dark-mode thead.border-line,
body.dark-mode tbody tr {
    border-color: #374151 !important;
}
body.dark-mode th.text-secondary {
    color: #9ca3af !important;
}

/* Table row hover effect */
body.dark-mode tr.item:hover {
    background-color: #374151 !important;
}

/* Table body text (td) */
body.dark-mode tbody td {
    color: #cbd5e1;
}

/* Job title in table */
body.dark-mode tbody .title {
    color: #ffffff;
}

/* Secondary text in table (location, etc.) */
body.dark-mode .text-secondary,
body.dark-mode .address {
    color: #9ca3af !important;
}

/* "Completed" status badge */
body.dark-mode .bg-green-100.text-green-700 {
    background-color: rgba(22, 163, 74, 0.2) !important;
    color: #4ade80 !important;
}

/* Status dropdown select */
body.dark-mode select[name="status"] {
    background-color: #374151;
    color: #ffffff;
    border-color: #4b5563;
}

/* Action buttons (Edit/Delete) */
body.dark-mode .btn_action {
    border-color: #4b5563;
    color: #cbd5e1;
}
body.dark-mode .btn_action:hover {
    background-color: #374151;
    border-color: #6b7280;
}

/* Pagination footer */
body.dark-mode .p-6.border-t {
    border-top-color: #374151 !important;
}
/* --- CREATE JOB PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("Submit Job") */
body.dark-mode h4.heading4[style*="color: #1b4cecff"] {
    color: #818cf8 !important; /* Lighter, less intense blue */
}

/* Form container ka background ("Information" wala box) */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
    box-shadow: none !important; /* Dark mode mein shadow ki zaroorat nahi */
}

/* Form ke labels (Title:, Description:, etc.) */
body.dark-mode .form label {
    color: #d1d5db; /* Light gray for labels */
}

/* Form ki tamam input fields */
body.dark-mode .form input[type="text"],
body.dark-mode .form input[type="number"],
body.dark-mode .form input[type="datetime-local"] {
    background-color: #374151; /* Dark input background */
    border-color: #4b5563;
    color: #ffffff; /* White text for input */
}

/* Input fields ke placeholder text ka color */
body.dark-mode .form input::placeholder {
    color: #9ca3af;
}

/* Date/Time picker icon ka color theek karein */
body.dark-mode input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
/* --- CREATE JOB PAGE KE LIYE DARK MODE CSS (Updated) --- */

/* Page ka main title ("Submit Job") */
body.dark-mode h4.heading4[style*="color: #1b4cecff"] {
    color: #818cf8 !important;
}

/* Form container ka background ("Information" wala box) */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
    box-shadow: none !important;
}

/* Form ke labels (Title:, Description:, etc.) */
body.dark-mode .form label {
    color: #d1d5db;
}

/* === YEH RAHA FIX === */
/* Form ki tamam input fields ko target karein */
body.dark-mode .form .border-line {
    background-color: #374151;
    border-color: #4b5563;
    color: #ffffff;
}

/* Input fields ke placeholder text ka color */
body.dark-mode .form .border-line::placeholder {
    color: #9ca3af;
}

/* Date/Time picker icon ka color theek karein */
body.dark-mode input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
/* --- APPLIED JOBS PAGE KE LIYE DARK MODE CSS --- */

/* Page ka title ("My Applied Jobs") */
body.dark-mode .text-3xl.font-bold {
    color: #ffffff;
}

/* Page ka subtitle */
body.dark-mode p.text-gray-600 {
    color: #9ca3af !important;
}

/* Main card ka background */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Job item ke darmiyan wali border line */
body.dark-mode .border-b {
    border-bottom-color: #374151 !important;
}

/* Job ka title */
body.dark-mode .text-gray-800 {
    color: #ffffff !important;
}

/* Job ki secondary info (location, pay, etc.) */
body.dark-mode .text-gray-500 {
    color: #9ca3af !important;
}

/* === YEH RAHA STATUS TAGS KA FIX === */

/* Approved Status */
body.dark-mode .bg-green-100.text-green-700 {
    background-color: rgba(22, 163, 74, 0.2) !important;
    color: #4ade80 !important;
}

/* Rejected Status */
body.dark-mode .bg-red-100.text-red-700 {
    background-color: rgba(239, 68, 68, 0.2) !important;
    color: #f87171 !important;
}

/* Pending Status */
body.dark-mode .bg-yellow-100.text-yellow-700 {
    background-color: rgba(245, 158, 11, 0.2) !important;
    color: #fbbf24 !important;
}

/* "No applications" wala message */
body.dark-mode p.text-center.text-gray-500 {
    color: #9ca3af !important;
}
/* --- MY COMPLAINTS PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("My Complaints") */
body.dark-mode .heading4 {
    color: #ffffff;
}

/* Main card ka background */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
}

/* Table header text aur border */
body.dark-mode thead.border-line,
body.dark-mode tbody tr {
    border-color: #374151 !important;
}
body.dark-mode th.text-secondary {
    color: #9ca3af !important;
}

/* Table body ka text */
body.dark-mode td.text-title {
    color: #ffffff !important; /* Subject ka text */
}
body.dark-mode td.text-secondary {
    color: #9ca3af !important; /* Date ka text */
}

/* === YEH RAHA HOVER KA FIX === */
/* Jab dark mode mein row par hover ho, to text ka color dark kar dein */
body.dark-mode tr.hover\:bg-background:hover td {
    color: #111827 !important; /* Dark text */
}
body.dark-mode tr.hover\:bg-background:hover td.text-secondary {
    color: #4b5563 !important; /* Dark secondary text */
}


/* Status badges ko dark mode ke liye behtar banayein */
body.dark-mode .bg-green-100 { background-color: rgba(22, 163, 74, 0.2) !important; }
body.dark-mode .text-green-800 { color: #4ade80 !important; }

body.dark-mode .bg-blue-100 { background-color: rgba(59, 130, 246, 0.2) !important; }
body.dark-mode .text-blue-800 { color: #60a5fa !important; }

body.dark-mode .bg-yellow-100 { background-color: rgba(245, 158, 11, 0.2) !important; }
body.dark-mode .text-yellow-800 { color: #fbbf24 !important; }

/* "No complaints" wala message */
body.dark-mode .p-5.text-center.text-secondary {
    color: #9ca3af !important;
}

/* Pagination footer */
body.dark-mode .p-6.border-t {
    border-top-color: #374151 !important;
}
/* --- FILE A COMPLAINT PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("File a New Complaint") */
body.dark-mode .heading4 {
    color: #ffffff;
}

/* Form container ka background */
body.dark-mode .bg-white {
    background-color: #1f2337 !important; /* Thora sa different dark shade */
}

/* Form header ki border line */
body.dark-mode .border-b.border-line {
    border-bottom-color: #374151 !important;
}

/* Form header ka text ("Complaint Details") */
body.dark-mode .heading5 {
    color: #ffffff;
}

/* Form ke labels (Subject, Describe your issue) */
body.dark-mode label.text-secondary {
    color: #d1d5db !important;
}

/* Form ki input aur textarea fields */
body.dark-mode .border.border-line {
    background-color: #374151 !important;
    border-color: #4b5563 !important;
    color: #ffffff !important;
}

/* Fields ke placeholder text ka color */
body.dark-mode input::placeholder,
body.dark-mode textarea::placeholder {
    color: #9ca3af;
}

/* Fields par focus karne par border color */
body.dark-mode .focus\:border-blue-500:focus {
    border-color: #60a5fa !important;
}

/* "Cancel" button ka text */
/* (Assuming .button-secondary has a light background and dark text) */
body.dark-mode .button-secondary {
    background-color: #4b5563 !important;
    color: #ffffff !important;
}
body.dark-mode .button-secondary:hover {
    background-color: #6b7280 !important;
}

/* Error messages ka background (agar koi error aye) */
body.dark-mode .bg-red-100 {
    background-color: rgba(239, 68, 68, 0.2) !important;
    border-color: rgba(239, 68, 68, 0.5) !important;
}
body.dark-mode .text-red-700 {
    color: #f87171 !important;
}
/* --- PROFILE SHOW PAGE KE LIYE DARK MODE CSS --- */

/* Page ka main title ("My Profile") */
body.dark-mode .heading4 {
    color: #ffffff;
}

/* Profile card ka background */
body.dark-mode .bg-white {
    background-color: #1f2937 !important;
}

/* Banner ka background color */
body.dark-mode .bg-gray-200 {
    background-color: #374151 !important;
}

/* Profile picture ke gird white border ko dark mode ke hisab se change karein */
body.dark-mode .border-white {
    border-color: #1f2937 !important; /* Card ke background jaisa */
}

/* User ka naam */
body.dark-mode .text-2xl.font-bold {
    color: #ffffff;
}

/* Secondary text (ratings, bio, info labels) */
body.dark-mode .text-secondary {
    color: #9ca3af !important;
}

/* Empty stars ka color */
body.dark-mode .text-gray-300 {
    fill: #4b5563 !important; /* SVG ke liye fill istemal karein */
    color: #4b5563 !important;
}

/* Horizontal line (hr) */
body.dark-mode hr {
    border-color: #374151 !important;
}

/* Info Overview section ka title */
body.dark-mode .heading5 {
    color: #ffffff;
}

/* Info Overview list ka text */
body.dark-mode .text-title {
    color: #e5e7eb !important;
}

/* Info Overview list ka hover effect */
body.dark-mode .hover\:bg-gray-50:hover {
    background-color: #374151 !important;
}

/* Map ki styling dark mode ke liye */
body.dark-mode #map {
    filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
}
/* --- EDIT PROFILE PAGE KE LIYE DARK MODE CSS (Updated) --- */

/* Page ka main title ("My Profile") */
body.dark-mode .heading4 {
    color: #ffffff;
}

/* Form container ka background ("Information" wala box) */
body.dark-mode .infomation.bg-white {
    background-color: #1f2937 !important;
    box-shadow: none !important;
}

/* "Information" title */
body.dark-mode .heading5 {
    color: #ffffff;
}

/* === YEH RAHA LABELS KA FIX === */
/* Form ke labels */
body.dark-mode .infomation label {
    color: #e5e7eb !important; /* White/Light Gray for labels */
}

/* === YEH RAHA BORDERS KA FIX === */
/* Form ki tamam input fields, textarea, etc. */
body.dark-mode .border-line {
    background-color: #374151 !important;
    border-color: #6b7280 !important; /* Light Gray/White Border */
    color: #ffffff !important;
}

/* Upload Avatar wala section */
body.dark-mode .bg-surface {
    background-color: #374151 !important;
}
body.dark-mode .text-button {
    color: #ffffff !important;
}
body.dark-mode .text-secondary {
    color: #9ca3af !important;
}
body.dark-mode .bg-line {
    background-color: #4b5563 !important;
    color: #e5e7eb;
}

body.dark-mode .infomation label {
    color: #ffffff !important; /* Labels ko zabardasti white karein */
}

/* --- ENHANCED ACCENT CARD KE LIYE DARK MODE CSS --- */

/* Main card ka background */
body.dark-mode .card-enhanced-accent {
    background-color: #1f2937; /* Dark Background */
    /* Note: Radial gradient pehle se iske upar apply ho jayega */
    border-color: rgba(255, 255, 255, 0.15); /* Border ko thora sa wazeh karein */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* Applicant count ka text */
body.dark-mode .applicant-count {
    color: #e5e7eb; /* Light Gray */
}

/* Job title ka text */
body.dark-mode .title {
    color: #ffffff; /* White */
}

/* Metadata ka text (location, date) */
body.dark-mode .meta {
    color: #9ca3af; /* Lighter secondary gray */
}
    </style>
</head>
<body class="lg:overflow-hidden">

    @include('layouts.partials.navbar')

    <div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
      
        @include('layouts.partials.sidebar')

        <div id="page-content-wrapper" class="content_dashboard flex-1 scrollbar_custom max-h-full w-full h-fit bg-surface">
            
            @if(session('success'))
                <div class="alert-success m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')

            
        </div>

    </div>

    <div class="flex items-center justify-center w-full h-15 bg-white duration-300 shadow-md mt-auto">
                <span class="copyright caption1 text-secondary">©2025 JobSplit. All Rights Reserved</span>
            </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/phosphor-icons.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script> 
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('scripts')
    @livewireScripts

<script>
    (function() {
        const toggleSwitch = document.getElementById('theme-toggle');
        // Aek alag key istemal karein taake website se conflict na ho
        const currentTheme = localStorage.getItem('dashboard_theme');

        if (currentTheme) {
            if (currentTheme === 'dark') {
                document.body.classList.add('dark-mode');
                if (toggleSwitch) {
                    toggleSwitch.checked = true;
                }
            }
        }

        if (toggleSwitch) {
            toggleSwitch.addEventListener('change', function(e) {
                if (e.target.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('dashboard_theme', 'dark');
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('dashboard_theme', 'light');
                }
            });
        }
    })();
</script>
</body>
</html>