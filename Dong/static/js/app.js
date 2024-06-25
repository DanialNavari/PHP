$(document).ready(function () {
    const datepickerDOM = $("#persianDatapicker");
    const dateObject = datepickerDOM.persianDatepicker(
        {
        "inline": false,
        "format": "LLLL",
        "viewMode": "day",
        "initialValue": true,
        "minDate": false,
        "maxDate": false,
        "autoClose": false,
        "position": "auto",
        "altFormat": "lll",
        "altField": "#altfieldExample",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": 800,
        "observer": false,
        "calendar": {
            "persian": {
                "locale": "fa",
                "showHint": true,
                "leapYearMode": "algorithmic"
            },
            "gregorian": {
                "locale": "en",
                "showHint": true
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
                "enabled": true
            },
            "text": {
                "btnNextText": "<",
                "btnPrevText": ">"
            }
        },
        "toolbox": {
            "enabled": true,
            "calendarSwitch": {
                "enabled": true,
                "format": "MMMM"
            },
            "todayButton": {
                "enabled": true,
                "text": {
                    "fa": "امروز",
                    "en": "Today"
                }
            },
            "submitButton": {
                "enabled": true,
                "text": {
                    "fa": "تایید",
                    "en": "Submit"
                }
            },
            "text": {
                "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": true,
            "step": 1,
            "hour": {
                "enabled": true,
                "step": null
            },
            "minute": {
                "enabled": true,
                "step": null
            },
            "second": {
                "enabled": true,
                "step": null
            },
            "meridian": {
                "enabled": false
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "responsive": true,
        "onSelect" : function(){
           
/*             alert(`تاریخ انتخاب شده : ${date.year}/${date.month}/${date.date} ~ ${date.hour}:${date.minute}:${date.second}`);
 */        }
    });

    const date = dateObject.getState().view;

    

    
});  