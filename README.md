# 🚌 BiyaheMMSU - Student Shuttle Tracker

### **Project Overview**
**BiyaheMMSU** is a real-time tracking application developed to streamline the daily commute of the Mariano Marcos State University (MMSU) community. It monitors shuttles traveling the route between **Laoag City** and **Paoay**.

---

### **Key Objectives**
* **Wait-Time Reduction:** Provides students with accurate shuttle locations so they can time their arrivals at the terminal.
* **Credential Verification:** A digital gateway that ensures only authorized drivers with valid Professional Licenses and OR/CR documents can offer services.
* **Operational Transparency:** Allows the university administration to monitor shuttle activity and manage driver quality through a centralized feedback system.

---

### **Tech Stack**
* **Framework:** Laravel 12 (PHP)
* **Database:** MySQL
* **Frontend:** Tailwind CSS & Blade Templating
* **Maps Integration:** Google Maps JavaScript API
* **Authentication:** Google OAuth 2.0 (Socialite)

---

### **Key Features**
1. **Admin Dashboard:** Verify driver documents and manage vehicle approvals.
2. **Driver Portal:** Upload requirements and toggle "Live Broadcasting" status.
3. **Student Tracker:** Real-time map interface to view available shuttles.
4. **Middleware Protection:** Secure routing that redirects users based on their verification status.