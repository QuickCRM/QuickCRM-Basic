# QuickCRM-Basic
/*********************************************************************************
 * 
 * QuickCRM Mobile Basic is a mobile web client and native app for SugarCRM
 * 
 * Author : NS-Team (http://www.quickcrm.fr/mobile)
 *
 * QuickCRM Mobile Basic is licensed under Affero GNU General Public License v3 (AGPLv3) 
 * 
 * You can contact NS-Team at NS-Team - 55 Chemin de Mervilla - 31320 Auzeville - France
 * or via email at quickcrm@ns-team.fr
 * 
 ********************************************************************************/

Interested in QuickCRM Mobile Pro?
Contact us at quickcrm@ns-team.fr or visit http://www.quickcrm.fr/mobile

Disclaimer:
-----------
The software and documents are distributed on an “AS IS” basis, WITHOUT WARRANTY OF ANY KIND, either express or implied.

Installation:
-------------
Download the Repository as a ZIP
**Due to a github issue, the ZIP will contain the files within folder, SuiteCRM expects the files to be at the root level of the zip folder**
Unzip the Zip folder and select the files inside of QuickCRM-Basic-master and zip these into a new folder which has them at the root level.
Accessthe administartion panel of your Suite installation and run the Module Loader
Upload the ZIP
Install.

Usage:
------
From your mobile, connect to <your-sugarcrm-url>/mobile or use native apps on iOS and Android.
You can then login with the same credentials you use for the web based client.

Change Log:
-----------
- 3.3.6 :
  * Fixed sort order bug in SugarCRM 6.5.15 to 6.5.20
- 3.3.5 :
  * Security Fix.
- 3.3.4 :
  * Fix bug with Russian language.
- 3.3.3 :
  * Fix bug with web app.
- 3.3.0 :
  * Fix bug in some SugarCRM translations preventing module installation.
  * New home page
  * Bug fixes
- 3.2.0 :
  * Clear searches
  * Supports Nederlands language
  * Bug fixes
- 3.1 :
  * New Homepage with a left panel giving quick access to Global Search and Last Viewed items
  * Display on a map Contacts/Accounts/... within a given distance from your current location (requires JJWG Design Google Maps)
  * Supports Traditional and Simplified Chinese language
- 3.0.0 :
  * New : Global search
  * New : Modules disabled in user's roles are automatically hidden
  * New : Offline mode (iOS and Android apps with Pro Version - SugarCRM version 6.3 or later)
  * Bug Fix : Display or edit special characters
  * Bug Fix : LDAP errors
- 2.6.1 :
  * Support for iOS and Android native apps version 2.6 (alerts for new assignments and personal data modified by other users)
  * Bug fix : Character \ in lists customized with Drop Down editor were not supported
  * Bug fix : Italian language
  * Bug fix : "Hide Empty subpanels" option was not displayed on web app in Options page
- 2.5.1 :
  * New: German interface
- 2.5.0 :
  * New: Support for Cases, Projects and Project Tasks (CE Version)
  * New: Add favorite saved searches to your home page (Pro Version)
  * New: Add create links to your home page (Pro Version)
  * New: Calendar has a new 30 days option (Pro Version)
  * New: Search email fields (Pro Version)
- 2.3.0 :
  * New: Customize Home page (a new option allow you to show/hide icons on the home page)
  * New: Converted contact, account and opportunity links on Leads view
  * New: Manage Custom Modules (Pro Version).
  * Support for upcoming iOS app
- 2.2.3 :
  * Bug Fix: Application could hang after a long period of inactivity or changing IP address
- 2.2.2 :
  * Support for Android app on SugarCRM 6.0 and 6.1
  * Bug Fix: Search by My Items.
  * Bug Fix: Display Contacts without account
- 2.2.1 :
  * Faster loading
  * Bug Fix: "Remember Me" didn't work on some situations.
  * Bug Fix: Date/Time Display on SugarCRM 6.0 and 6.1
- 2.2 :
  * New: "Remember Me" checkbox on login page.
  * New: Define sort order for modules in options page.
  * New: Calls and Meetings are available on Home page
  * New: Calls can be placed directly from any list when the record has phone numbers
  * New: Download link on Notes with attachments (displaying the attachment might require specific software on some devices)
  * New: Numeric fields can be used as search criteria (Pro version)
  * New: Upload attachments on Notes if authorized by device (Pro version)
  * New: Create button in Search page, List page and All Modules page (Pro Version)
  * New: Date Picker widget (Pro Version)
  * Bug fixes
- 2.0.5 :
  * Faster navigation
- 2.0.4 :
  * Italian language interface
  * Bug fix: Incorrect display of calls or meetings time after Daylight Saving Time adjustment
- 2.0.3 :
  * New: Interface with a toolbar for quick access to main functions
  * New: All Modules page allowing search of Meetings and Calls
  * New: My Items option in search pages is now saved from one session to another
  * New: Display total number of elements in list view (SugarCRM 6.5 and later)
  * New: Support for Cases, Projects and Project Tasks, Advanced OpenSales (Pro Version)
  * New: Admin interface for selection of displayed fields and search criteria (Pro Version)
  * New: Support for multienum fields (Pro Version)
  * New: Delete function (Pro Version)
- 1.6.5 :
  * New: Send SMS button on mobile phone numbers
  * New: Log Call function : calling by clicking on a phone number creates a Call in SugarCRM (Pro Version)
  * New: create/edit Tasks and Notes (Pro Version)
- 1.5.5 :
  * Bug fix : Impossible to login in some configurations
- 1.5.4 :
  * Bug fix : Update fields function did not work on some linux servers
- 1.5.3 :
  * New Last viewed function
- 1.3.7 :
  * Bug fixes
- 1.3.6 :
  * Bug fix : Time for Calls and Meetings incorrectly displayed
- 1.3.5 :
  * Bug fix : Improved Time Zone support for some browsers
  * Bug fix : Application could hang after login if $site_url variable was not correctly defined in config.php 
- 1.3.4 :
  * Optimizations and improved browser support thanks to jQueryMobile 1.1 
  * Changes made in drop-down editor are taken into account
  * Bug fix : missing translation for tasks
- 1.3.1 :
  * User name is memorized 
  * Bug fix : List of Leads was not displayed when Leads had no account
- 1.3 :
   * Custom Search fields in Accounts, Contacts, Opportunities, Tasks and Leads. (Pro version)
     Any field of type text, date or enum can be used in search criteria
   * Search by "My Items" (CE version)
   * Bug fix : Meetings and calls cound not be displayed with Leads or Contacts without first name
   * Bug fix : Account country current value was not displayed in Edit form
   * Bug fix : date or datetime fields could not be entered properly on some browsers
- 1.2 :
   * Optimizations and improved browser support thanks to jQueryMobile 1.0.1
- 1.1 :
   * New Opportunities and Tasks list
   * Added spanish support (thanks to Mediterranean Consulting)
   * Fix bugs when SugarCRM default language is not english or french
- 1.02 :
   * Fix bugs when displaying a contact with a mobile phone
- 1.01 :
   * Fix bugs with SugarCRM 6.2 and 6.3
   * Fix bug when searching contacts with empty first name or last name
   
