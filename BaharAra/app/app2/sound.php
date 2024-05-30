<!-- <!doctype html>
<html lang="en" class="h5p-iframe">

<head>
    <meta charset="utf-8">
    <title>Audio Recorder</title>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/jquery.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-event-dispatcher.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-x-api-event.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-x-api.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-content-type.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-confirmation-dialog.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-action-bar.js?rwykd6"></script>
    <script src="https://h5p.org/sites/all/modules/h5p/library/js/request-queue.js?rwykd6"></script>
    <script src="https://h5p.org/sites/default/files/h5p/libraries/H5P.AudioRecorder-1.0/dist/h5p-audio-recorder.js?ver=1.0.32"></script>
    <script src="https://h5p.org/sites/all/modules/h5p_ga/h5p-ga.js?ver=0.0.1"></script>
    <script src="https://h5p.org/sites/all/modules/h5p_org/scripts/ga.js?ver=1"></script>
    <script src="https://h5p.org/sites/all/modules/h5p_org/scripts/h5p-org-try-out-message-embed-popup.js?ver=1"></script>
    <link rel="stylesheet" href="https://h5p.org/sites/all/modules/h5p/library/styles/h5p.css?rwykd6">
    <link rel="stylesheet" href="https://h5p.org/sites/all/modules/h5p/library/styles/h5p-confirmation-dialog.css?rwykd6">
    <link rel="stylesheet" href="https://h5p.org/sites/all/modules/h5p/library/styles/h5p-core-button.css?rwykd6">
    <link rel="stylesheet" href="https://h5p.org/sites/default/files/h5p/libraries/FontAwesome-4.5/h5p-font-awesome.min.css?ver=4.5.4">
    <link rel="stylesheet" href="https://h5p.org/sites/default/files/h5p/libraries/H5P.FontIcons-1.0/styles/h5p-font-icons.css?ver=1.0.6">
    <link rel="stylesheet" href="https://h5p.org/sites/default/files/h5p/libraries/H5P.AudioRecorder-1.0/fonts/h5p-audio-recorder-font-open-sans.css?ver=1.0.32">
    <link rel="stylesheet" href="https://h5p.org/sites/all/modules/h5p_org/styles/h5p-org-embed-try-out-message.css?ver=1">
</head>

<body>
    <div class="h5p-content" data-content-id="1214919"></div>
    <script>
        H5PIntegration = {
            "baseUrl": "https:\/\/h5p.org",
            "url": "\/sites\/default\/files\/h5p",
            "postUserStatistics": false,
            "ajax": {
                "setFinished": "\/h5p-ajax\/set-finished.json?token=6e4621da53473",
                "contentUserData": "\/h5p-ajax\/content-user-data\/:contentId\/:dataType\/:subContentId?token=25938320a6b49"
            },
            "saveFreq": false,
            "l10n": {
                "H5P": {
                    "fullscreen": "Fullscreen",
                    "disableFullscreen": "Disable fullscreen",
                    "download": "Download",
                    "copyrights": "Rights of use",
                    "embed": "Embed",
                    "size": "Size",
                    "showAdvanced": "Show advanced",
                    "hideAdvanced": "Hide advanced",
                    "advancedHelp": "Include this script on your website if you want dynamic sizing of the embedded content:",
                    "copyrightInformation": "Rights of use",
                    "close": "Close",
                    "title": "Title",
                    "author": "Author",
                    "year": "Year",
                    "source": "Source",
                    "license": "License",
                    "thumbnail": "Thumbnail",
                    "noCopyrights": "No copyright information available for this content.",
                    "reuse": "Reuse",
                    "reuseContent": "Reuse Content",
                    "reuseDescription": "Reuse this content.",
                    "downloadDescription": "Download this content as a H5P file.",
                    "copyrightsDescription": "View copyright information for this content.",
                    "embedDescription": "View the embed code for this content.",
                    "h5pDescription": "Visit H5P.org to check out more cool content.",
                    "contentChanged": "This content has changed since you last used it.",
                    "startingOver": "You'll be starting over.",
                    "by": "by",
                    "showMore": "Show more",
                    "showLess": "Show less",
                    "subLevel": "Sublevel",
                    "confirmDialogHeader": "Confirm action",
                    "confirmDialogBody": "Please confirm that you wish to proceed. This action is not reversible.",
                    "cancelLabel": "Cancel",
                    "confirmLabel": "Confirm",
                    "licenseU": "Undisclosed",
                    "licenseCCBY": "Attribution",
                    "licenseCCBYSA": "Attribution-ShareAlike",
                    "licenseCCBYND": "Attribution-NoDerivs",
                    "licenseCCBYNC": "Attribution-NonCommercial",
                    "licenseCCBYNCSA": "Attribution-NonCommercial-ShareAlike",
                    "licenseCCBYNCND": "Attribution-NonCommercial-NoDerivs",
                    "licenseCC40": "4.0 International",
                    "licenseCC30": "3.0 Unported",
                    "licenseCC25": "2.5 Generic",
                    "licenseCC20": "2.0 Generic",
                    "licenseCC10": "1.0 Generic",
                    "licenseGPL": "General Public License",
                    "licenseV3": "Version 3",
                    "licenseV2": "Version 2",
                    "licenseV1": "Version 1",
                    "licensePD": "Public Domain",
                    "licenseCC010": "CC0 1.0 Universal (CC0 1.0) Public Domain Dedication",
                    "licensePDM": "Public Domain Mark",
                    "licenseC": "Copyright",
                    "contentType": "Content Type",
                    "licenseExtras": "License Extras",
                    "changes": "Changelog",
                    "contentCopied": "Content is copied to the clipboard",
                    "connectionLost": "Connection lost. Results will be stored and sent when you regain connection.",
                    "connectionReestablished": "Connection reestablished.",
                    "resubmitScores": "Attempting to submit stored results.",
                    "offlineDialogHeader": "Your connection to the server was lost",
                    "offlineDialogBody": "We were unable to send information about your completion of this task. Please check your internet connection.",
                    "offlineDialogRetryMessage": "Retrying in :num....",
                    "offlineDialogRetryButtonLabel": "Retry now",
                    "offlineSuccessfulSubmit": "Successfully submitted results.",
                    "mainTitle": "Sharing <strong>:title<\/strong>",
                    "editInfoTitle": "Edit info for <strong>:title<\/strong>",
                    "cancel": "Cancel",
                    "back": "Back",
                    "next": "Next",
                    "reviewInfo": "Review info",
                    "share": "Share",
                    "saveChanges": "Save changes",
                    "registerOnHub": "Register on the H5P Hub",
                    "updateRegistrationOnHub": "Save account settings",
                    "requiredInfo": "Required Info",
                    "optionalInfo": "Optional Info",
                    "reviewAndShare": "Review & Share",
                    "reviewAndSave": "Review & Save",
                    "shared": "Shared",
                    "currentStep": "Step :step of :total",
                    "sharingNote": "All content details can be edited after sharing",
                    "licenseDescription": "Select a license for your content",
                    "licenseVersion": "License Version",
                    "licenseVersionDescription": "Select a license version",
                    "disciplineLabel": "Disciplines",
                    "disciplineDescription": "You can select multiple disciplines",
                    "disciplineLimitReachedMessage": "You can select up to :numDisciplines disciplines",
                    "discipline": {
                        "searchPlaceholder": "Type to search for disciplines",
                        "in": "in",
                        "dropdownButton": "Dropdown button"
                    },
                    "removeChip": "Remove :chip from the list",
                    "keywordsPlaceholder": "Add keywords",
                    "keywords": "Keywords",
                    "keywordsDescription": "You can add multiple keywords separated by commas. Press \"Enter\" or \"Add\" to confirm keywords",
                    "altText": "Alt text",
                    "reviewMessage": "Please review the info below before you share",
                    "subContentWarning": "Sub-content (images, questions etc.) will be shared under :license unless otherwise specified in the authoring tool",
                    "disciplines": "Disciplines",
                    "shortDescription": "Short description",
                    "longDescription": "Long description",
                    "icon": "Icon",
                    "screenshots": "Screenshots",
                    "helpChoosingLicense": "Help me choose a license",
                    "shareFailed": "Share failed.",
                    "editingFailed": "Editing failed.",
                    "shareTryAgain": "Something went wrong, please try to share again.",
                    "pleaseWait": "Please wait...",
                    "language": "Language",
                    "level": "Level",
                    "shortDescriptionPlaceholder": "Short description of your content",
                    "longDescriptionPlaceholder": "Long description of your content",
                    "description": "Description",
                    "iconDescription": "640x480px. If not selected content will use category icon",
                    "screenshotsDescription": "Add up to five screenshots of your content",
                    "submitted": "Submitted!",
                    "isNowSubmitted": "Is now submitted to H5P Hub",
                    "changeHasBeenSubmitted": "A change has been submited for",
                    "contentAvailable": "Your content will normally be available in the Hub within one business day.",
                    "contentUpdateSoon": "Your content will update soon",
                    "contentLicenseTitle": "Content License Info",
                    "licenseDialogDescription": "Click on a specific license to get info about proper usage",
                    "publisherFieldTitle": "Publisher",
                    "publisherFieldDescription": "This will display as the \"Publisher name\" on shared content",
                    "emailAddress": "Email Address",
                    "publisherDescription": "Publisher description",
                    "publisherDescriptionText": "This will be displayed under \"Publisher info\" on shared content",
                    "contactPerson": "Contact Person",
                    "phone": "Phone",
                    "address": "Address",
                    "city": "City",
                    "zip": "Zip",
                    "country": "Country",
                    "logoUploadText": "Organization logo or avatar",
                    "acceptTerms": "I accept the <a href=\":url\" target=\"_blank\">terms of use<\/a>",
                    "successfullyRegistred": "You have successfully registered an account on the H5P Hub",
                    "successfullyRegistredDescription": "You account details can be changed",
                    "successfullyUpdated": "Your H5P Hub account settings have successfully been changed",
                    "accountDetailsLinkText": "here",
                    "registrationTitle": "H5P Hub Registration",
                    "registrationFailed": "An error occurred",
                    "registrationFailedDescription": "We were not able to create an account at this point. Something went wrong. Try again later.",
                    "maxLength": ":length is the maximum number of characters",
                    "keywordExists": "Keyword already exists!",
                    "licenseDetails": "License details",
                    "remove": "Remove",
                    "removeImage": "Remove image",
                    "cancelPublishConfirmationDialogTitle": "Cancel sharing",
                    "cancelPublishConfirmationDialogDescription": "Are you sure you want to cancel the sharing process?",
                    "cancelPublishConfirmationDialogCancelButtonText": "No",
                    "cancelPublishConfirmationDialogConfirmButtonText": "Yes",
                    "add": "Add",
                    "age": "Typical age",
                    "ageDescription": "The target audience of this content. Possible input formats separated by commas: \"1,34-45,-50,59-\".",
                    "invalidAge": "Invalid input format for Typical age. Possible input formats separated by commas: \"1, 34-45, -50, -59-\".",
                    "contactPersonDescription": "H5P will reach out to the contact person in case there are any issues with the content shared by the publisher. The contact person's name or other information will not be published or shared with third parties",
                    "emailAddressDescription": "The email address will be used by H5P to reach out to the publisher in case of any issues with the content or in case the publisher needs to recover their account. It will not be published or shared with any third parties",
                    "copyrightWarning": "Copyrighted material cannot be shared in the H5P Content Hub. If the content is licensed with a OER friendly license like Creative Commons, please choose the appropriate license. If not this content cannot be shared.",
                    "keywordsExits": "Keywords already exists!",
                    "someKeywordsExits": "Some of these keywords already exist"
                }
            },
            "hubIsEnabled": true,
            "reportingIsEnabled": true,
            "crossorigin": null,
            "crossoriginCacheBuster": null,
            "libraryConfig": null,
            "pluginCacheBuster": "?rwykd6",
            "libraryUrl": "\/sites\/all\/modules\/h5p\/library\/js",
            "siteUrl": "https:\/\/h5p.org\/",
            "contents": {
                "cid-1214919": {
                    "library": "H5P.AudioRecorder 1.0",
                    "jsonContent": "{\"l10n\":{\"recordAnswer\":\"Record\",\"pause\":\"Pause\",\"continue\":\"Continue\",\"download\":\"Download\",\"done\":\"Done\",\"retry\":\"Retry\",\"microphoneNotSupported\":\"Microphone not supported. Make sure you are using a browser that allows microphone recording.\",\"microphoneInaccessible\":\"Microphone is not accessible. Make sure that the browser microphone is enabled.\",\"insecureNotAllowed\":\"Access to microphone is not allowed in your browser since this page is not served using HTTPS. Please contact the author, and ask him to make this available using HTTPS\",\"statusReadyToRecord\":\"Press a button below to record your answer.\",\"statusRecording\":\"Recording...\",\"statusPaused\":\"Recording paused. Press a button to continue recording.\",\"statusFinishedRecording\":\"You have successfully recorded your answer! Listen to the recording below.\",\"downloadRecording\":\"Download this recording or retry.\",\"retryDialogHeaderText\":\"Retry recording?\",\"retryDialogBodyText\":\"By pressing &quot;Retry&quot; you will loose your current recording.\",\"retryDialogConfirmText\":\"Retry\",\"retryDialogCancelText\":\"Cancel\",\"statusCantCreateTheAudioFile\":\"Can&#039;t create the audio file.\"},\"title\":\"Count to five in French!\"}",
                    "fullScreen": "0",
                    "exportUrl": "https:\/\/h5p.org\/sites\/default\/files\/h5p\/exports\/audio-recorder-142-1214919.h5p",
                    "embedCode": "<iframe src=\"https:\/\/h5p.org\/h5p\/embed\/71393\" width=\":w\" height=\":h\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" allow=\"geolocation *; microphone *; camera *; midi *; encrypted-media *\" title=\"Audio Recorder\"><\/iframe>",
                    "resizeCode": "<script src=\"https:\/\/h5p.org\/sites\/all\/modules\/h5p\/library\/js\/h5p-resizer.js\" charset=\"UTF-8\"><\/script>",
                    "mainId": "71393",
                    "url": "https:\/\/h5p.org\/node\/71393",
                    "contentUserData": [{
                        "state": "{}"
                    }],
                    "displayOptions": {
                        "frame": true,
                        "export": true,
                        "embed": true,
                        "copyright": true,
                        "icon": true,
                        "copy": false
                    },
                    "metadata": {
                        "license": "U",
                        "defaultLanguage": "en",
                        "title": "Audio Recorder"
                    }
                }
            }
        };
    </script>
    <style>
        .recording-indicator-wrapper,
        .h5p-audio-recorder-view .title,
        .h5p-audio-recorder-view [role=status],
        .h5p-content ul.h5p-actions,
        .h5p-audio-recorder-download,
        a.button.download,
        .h5p-confirmation-dialog-header {
            display: none;
        }

        .h5p-audio-recorder-view .button.retry {
            margin-top: 1rem;
        }
    </style>
</body>

</html> -->