<x-guest-layout>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    .center-portal {
        display: flex;
        flex-direction: column;
        align-items: center;     /* horizontal centering */
        background: linear-gradient(90deg, #f8fafc 0%, #e0e7ef 100%);
    }
    .login-btn {
        margin-top: 40px;
        padding: 15px 48px;
        border-radius: 26px;
        background: #345bb2;
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
        border: none;
        box-shadow: 0 2px 8px #bbc3e8;
        transition: background 0.2s;
        cursor: pointer;
    }

    .hero {
        background: linear-gradient(90deg, #f8fafc 0%, #e0e7ef 100%);
        padding: 60px 0 30px 0;
        text-align: center;
    }
    .steps {
        display: flex; gap: 32px; justify-content: center; margin: 40px 0;
        flex-wrap: wrap;
    }
    .step-card {
        background: #fff; border-radius: 18px; box-shadow: 0 2px 8px #e3e8ee;
        padding: 32px 24px; width: 220px; text-align: center; margin-bottom: 16px;
    }
    .step-icon {
        font-size: 38px; margin-bottom: 10px; color: #3677dd;
    }
    .features {
        display: flex; gap: 30px; justify-content: center; margin: 36px 0;
        flex-wrap: wrap;
    }
    .feature-card {
        background: #f3f8ff; border-radius: 12px; padding: 24px 16px; width: 280px;
        box-shadow: 0 1px 5px #e2e8f0; text-align: center;
    }
    .feature-icon {
        font-size: 34px; color: #5ca769; margin-bottom: 8px;
    }
    .login-btn:hover {
        background: #25407c;
    }
    .portal-footer {
        text-align: center; margin-top: 40px; font-size: 0.95em; color: #6c757d;
        padding-bottom: 24px;
    }
</style>

<div class="hero">
    <div style="display:flex;justify-content:center;align-items:center;margin-top:25px;">
    <img src="{{ asset('assets/img/logokict.png') }}" alt="MYKICT" width="80" />
</div>

<div class="center-portal">
    <h1 style="font-size:2.5rem;font-weight:700;margin-bottom:10px;">
        Plan Your Study, Shape Your Future
    </h1>
    <p style="font-size:1.15rem;max-width:600px;margin:0 auto 25px auto;color:#556">
        MYKICT: Smart Study Planner helps IIUM students select courses, track their academic path, and optimize graduation timelines. Less confusion, more confidence—your study journey made simple.
    </p>
    <a href="{{ route('login') }}" class="login-btn">Login to MYKICT</a>
</div>

<div class="steps">
    <div class="step-card">
        <div class="step-icon"><i class="fas fa-lightbulb"></i></div>
        <h5>Plan</h5>
        <small>Auto-suggests the best courses based on your program & CGPA</small>
    </div>
    <div class="step-card">
        <div class="step-icon"><i class="fas fa-user-cog"></i></div>
        <h5>Personalize</h5>
        <small>Customize your study plan to fit your pace and specialization</small>
    </div>
    <div class="step-card">
        <div class="step-icon"><i class="fas fa-save"></i></div>
        <h5>Save</h5>
        <small>One-click to save your selected plan for the semester</small>
    </div>
    <div class="step-card">
        <div class="step-icon"><i class="fas fa-chart-line"></i></div>
        <h5>Track</h5>
        <small>Visualize your academic progress & stay on target for graduation</small>
    </div>
</div>

<div class="features">
    <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
        <strong>Automated Course Suggestions</strong>
        <p style="margin:10px 0 0 0;font-size:0.99rem;">
            Intelligent planner suggests courses that fit your year, specialization, and CGPA status.
        </p>
    </div>
    <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-users-cog"></i></div>
        <strong>Personalized Study Experience</strong>
        <p style="margin:10px 0 0 0;font-size:0.99rem;">
            Manage elective preferences, visualize study paths, and avoid timetable clashes.
        </p>
    </div>
    <div class="feature-card">
        <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
        <strong>Progress Monitoring & Prediction</strong>
        <p style="margin:10px 0 0 0;font-size:0.99rem;">
            See your progress, track credit hours, and predict graduation time—all in one portal.
        </p>
    </div>
</div>

<div class="portal-footer">
    <span>
        Project by: <strong>Nur Fatihah Adawiyah binti Rusdi | Nur Ain binti Lizam</strong> &bull; IIUM KICT<br>
        Powered by Laravel &bull; Supervised by: Dr. Mohd Khairul Azmi bin Hassan
    </span>
</div>

{{-- Add FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</x-guest-layout>

