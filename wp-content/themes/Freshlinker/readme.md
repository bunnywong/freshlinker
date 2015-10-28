# JobBoard version 2.0.4 (Since May 25, 2015)
### Changelogs:
```
* Fix: translation bug
```

### Modified files:
```
* languages/en_GB.po

```

# JobBoard version 2.0.3 (Since May 04, 2015)
### Changelogs:
```
* Add: Resume view subscription feature
* Add: Forgot password link
* Fix: Clickable parent menu in main navigation
```

### Modified files:
```
* assets/js/theme-script.js
* style.css
* single-resume.php
* admin/theme-options/theme-options.php
* includes/package-system/package.php
* includes/theme-functions.php
* page-templates/template-login.php
* template-parts/dashboard-job_lister.php
* template-parts/dashboard-job_seeker.php
* includes/resume-subscription/

```


# JobBoard version 2.0.2 (April 24, 2015)
### Changelogs:
```
* Add: Security update
* Fix: Log in processing issue with MailChimp
* Fix: Hidden metaboxes for add/edit company screen in WordPress backend
```

### Modified files:
```
* includes/theme-enqueue.php
* content-blog.php
* includes/package-system/package.php
* includes/theme-functions.php
* page-templates/template-add_company.php
* page-templates/template-login.php
* page-templates/template-post_job.php
* page-templates/template-post_resume.php
* template-parts/dashboard-job_lister.php
* template-parts/modal-apply_job.php
```


# JobBoard version 2.0.1 (April 17, 2015)
### Changelogs:
```
* Fix: Pakcage system bug redirecting to dashboard page for recume/job entry if package disabled
* Add: Allow site administrator to post job or resume without package enabled
```

### Modified file:
```
* includes/package-system/package.php
```

# JobBoard version 2.0 (April 02, 2015)
### Changelogs:
```
* Add: Resume package system (Maximum resumes can be posted after payment)
* Add: Job package system (Maximum jobs can be posted after payment)
* Fix: Foreach preceded by if check
* Fix: Date format in dashboard page
* Fix: Typo of "Salary"
* Fix: Restrict job seeker to add company
* Fix: Restrict job seeker to add job
* Fix: Restrict job lister to add resume
```
### Modified file:
```
* admin/metaboxes/metabox-job.php
* admin/metaboxes/metabox-resume.php
* admin/theme-options/theme-options.php
* includes/theme-functions.php
* page-templates/template-post_job.php
* page-templates/template-post_resume.php
* page-templates/template-add_company.php
* single-resume.php
* template-parts/dashboard-job_lister.php
* template-parts/dashboard-job_seeker.php
* template-parts/job_listing-related.php
* template-parts/homepage-company.php
* single-job.php
* style.css
```
### New Added Files:
* includes/package-system/package.php
* includes/package-system/package-job-setting.php
* includes/package-system/package-resume-setting.php
```


```

# JobBoard version 1.7 (March 23, 2015)
### Changelogs:
```
* Update: Title tag
* Update: Forgot password
* Update: Paid feature listing
* Update: Adding link to company slider in homepage footer
* Update: Auto publish or pending option for resume submission
* Fix: Currency thousand separator output in single job page
```
### Modified file:
```
* header.php
* functions.php
* admin/theme-admin.php
* includes/theme-functions.php
* includes/theme-functions.php
* admin/metaboxes/metabox-slider.php
* page-templates/template-login.php
* template-parts/homepage-company.php
* admin/theme-options/theme-options.php
* template-parts/dashboard-job_lister.php
* page-templates/template-post_resume.php


```

### Screenshots:
```
One slider for two locations:
* Add/edit slider: http://awesomescreenshot.com/0144n79dab
* Activating main slider: http://awesomescreenshot.com/0a64n7ba2f
* Activating company slider: http://awesomescreenshot.com/00c4n7ax80
```


# JobBoard version 1.6.6 (March 16, 2015)
### Changelogs:
```
* Fix: Resume filter by location
```
### Modified file:
```
* includes/theme-functions.php
* template-parts/listing-resume_listing.php

```




# JobBoard version 1.6.5 (March 12, 2015)
### Changelogs:
```
* Fix: Submenu dropdown of main menu on mobile device
```
### Modified file:
```
* assets/js/theme-script.js
```



# JobBoard version 1.6.4 (March 8, 2015)
### Changelogs:
```
* Fix: Apply button visibility regarding job status (closed/open)
```
### Modified file:
```
* includes/theme-functions.php
```



# JobBoard version 1.6.3 (February 22, 2015)
### Changelogs:
```
* Fix: URL metabox field validation
```
### Modified file:
```
* admin/metaboxes/metabox-job.php
```

# JobBoard version 1.6.2 (February 3, 2015)
### Changelogs:
```
* Fix: Resume filter result
* Fix: CSS registering for child theme support
```
### Modified files:
```
* style.css
* single-company.php
* single-resume.php
* includes/theme-enqueue.php
* includes/theme-functions.php
* template-parts/listing-resume_search.php
* template-parts/listing-resume_listing.php

```
### Update version notes:

If you have already created resume(s) using Jobboard version 1.6.1 or older you need to update resume metadata using [this plugin](http://demo.puriwp.com/jobboard/wp-content/plugins/jobboard-resume-metadata-updater.zip "Jobboard Resume Metadata Updater") in order to make resume filter works with the latest Jobboard version.

Here are the steps:

1. Install and activate the plugin
2. Go to <strong>Resumes</strong> > <strong>Update Metadata</strong>
3. Click <strong>Update Now</strong>. You are done!
4. Uninstall the plugin


# JobBoard version 1.6.1 (January 27, 2015)
### Changelogs:
```
* Fix: contact form sending email on company page
```
### Modified files:
```
* style.css
* single-company.php
```

# JobBoard version 1.6 (January 19, 2015)
### Changelogs:
```
* Add advanced search feature
* Add job category link on job detail
* Add job category archive page
```
### New added files:
```
* taxonomy-job_category.php
* assets/js/advance-search.js
* template-parts/listing-job_listing_archive.php
```
### Modified files:
```
* style.css
* single-job.php
* style-responsive.css
* assets/js/theme-script.js
* template-parts/form-job_search.php
* admin/theme-options/theme-options.php
```

# JobBoard version 1.5 (January 16, 2015)

### Changelogs:
```
* Fix: minor CSS bug of view resume button
* Fix: error update user profile info
* Fix: user menu dropdown link item tab issue on mobile device
```
### Modified files:
```
* style.css
* style-responsive.css
* assets/js/bootstrap.min.js
```

# JobBoard version 1.4 (January 10, 2015)

### Changelogs:
```
* Add resume listing
* Add refine resume feature
* Update post resume form field
```

### Modified files:
```
* style.css
* index.php
* functions.php
* single-company.php
* assets/css/company.css
* assets/css/company.scss
* template-parts/listing-resume_search.php
* template-parts/listing-resume_listing.php
* page-templates/template-post_resume.php
* page-templates/template-resume_listing.php
```


# JobBoard version 1.3.1 (Desember 28, 2014)

### Changelogs:
```
* Add registered user notification to admin email and user email
* Add reset password feature
```

### Modified files:
```
* style.css
* includes/theme-functions.php
* page-templates/template-login.php
* page-templates/template-register.php
```

# JobBoard version 1.3 (Desember 27, 2014)

### Chengelogs:
```
* Add company page
* Add company link
* Update company edit (front-end editor) page
```

### Modified files:
```
* style.css
* archive.php
* functions.php
* single-job.php
* single-company.php
* assets/js/map.js
* assets/js/theme-script.js
* admin/theme-admin.php
* admin/metaboxes/metabox-company.php
* admin/metaboxes/metabox-job.php
* includes/theme-enqueue.php
* includes/theme-functions.php
* page-templates/template-add_company.php
* page-templates/template-contact.php
* template-parts/homepage-jobs_listing.php
* template-parts/dashboard-job_lister.php
* template-parts/dashboard-job_seeker.php
* includes/widgets/widget-featured_jobs.php

```

### New files:
```
* single-company.php
* assets/css/company.css
* assets/css/company.scss
* assets/css/jobboard-admin.css
* assets/css/jobboard-admin.scss
* assets/images/fa-blockquote.png
* admin/metaboxes/metabox-company-clients.php
* admin/metaboxes/metabox-company-address.php
* admin/metaboxes/metabox-company-services.php
* admin/metaboxes/metabox-company-expertises.php
* admin/metaboxes/metabox-company-portfolios.php
* admin/metaboxes/metabox-company-testimonial.php
```

# JobBoard version 1.2 (Desember 20, 2014)

### Chengelogs:
```
* Fix edit company permalink
```

### Modified files:
```
* template-parts/dashboard-job_lister.php
```


# JobBoard version 1.1 (November 25, 2014)

### Chengelogs:
```
* Add registration success message
* Add profile settings page (front-end editor)
```

### Modified files:
```
* style.css
* admin/data-source.php
* admin/theme-options/theme-options.php
* includes/theme-functions.php
* page-templates/template-register.php
* template-parts/dashboard-job_seeker.php
```

### New added files:
```
* page-templates/template-user-settings.php
```


# JobBoard version 1.0 (November 7, 2014)
```
* Initial release
```
