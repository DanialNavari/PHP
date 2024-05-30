<style>
    legend {
        font-size: 0.9rem;
        width: fit-content;
        text-align: center;
        background: #525254;
        padding-right: 0.4rem;
        padding-left: 0.4rem;
    }

    fieldset {
        color: #fff;
    }

    fieldset.hor {
        flex-direction: column;
    }

    h6 {
        margin-bottom: 1rem;
    }

    .progress {
        height: 1.2rem;
        border-radius: 0.8rem;
    }

    .load_page {
        height: 91.8vh;
        width: 100%;
        background: #313133;
        margin-top: 2.9rem;
    }

    .load_item {
        padding: 10rem 0;
        color: #fff;
        width: inherit;
        text-align: center;
    }

    .cbd_info {
        width: 80%;
        margin-top: 0.5rem;
    }

    .cbd_info .row {
        margin-bottom: 1.2rem;
    }

    .row .btn {
        width: 7rem;
        padding: 0.2rem;
        font-size: 0.9rem;
        font-weight: bold;
        margin: 0.5rem auto;
    }

    .deactive {
        background-color: #999898;
        border: 1px solid #999898;
    }

    .row span {
        font-size: 0.8rem;
    }

    #my_hood {
        font-size: 0.8rem;
        background: #e15361;
        padding: 0.1rem 0.3rem;
        border-radius: 1rem;
    }

    fieldset input {
        margin-bottom: 1rem;
    }

    #buy_pos {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
        margin: 1rem auto;
    }

    #buy_pos button {
        width: 7rem;
        padding: 0.2rem;
        font-size: 0.9rem;
        font-weight: bold;
        margin: 0.5rem 0.5rem;
        cursor: pointer;
    }

    input#uids,
    #uid {
        display: none;
    }

    #customer_type {
        display: flex;
        direction: ltr;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: flex-start;
        width: 67%;
    }

    input[type="radio"] {
        margin-left: 2rem;
    }

    #send_time input[type="radio"] {
        margin-left: 2rem;
        width: 2rem;
        height: 2rem;
        vertical-align: middle;
    }

    table {
        margin-right: 0.6rem;
    }

    td {
        text-align: right;
    }

    #ff td {
        text-align: center;
    }

    td img {
        width: 6rem;
        height: 6rem;
        border-radius: 3rem;
        box-shadow: 0px 1px 4px 2px silver;
        margin-bottom: 1rem;
        margin-left: 0.6rem;
        cursor: pointer;
        padding: 0.5rem;
        margin-top: 0.4rem;
    }

    .full_screen img {
        width: 150%;
        height: 100%;
        margin-right: -7rem;
    }

    .full_screen {
        height: 100vh;
        width: 100%;
        overflow: hidden;
        display: none;
    }

    .result_pos {
        display: none;
        height: 8vh;
        margin-top: 3rem;
        color: #fff;
        text-align: center;
        padding: 0.7rem;
        margin-bottom: -3rem;
        width: 100%;
        position: absolute;
        top: 0;
        right: 0;
    }

    #final_pay_btn,
    #show_basket,
    #return_cat,
    #final_save {
        height: 2.5rem;
        margin-left: 0.5rem;
    }

    .final_pay_btn {
        display: none;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 0 auto;
        background: #525254;
        padding: 0.4rem;
        position: fixed;
        bottom: 0;
        right: 0;
    }

    .show_factor {
        position: fixed;
        background: #525254;
        padding: 1rem;
        width: 100%;
        color: #fff;
        min-height: 92vh;
        margin-top: -0.5rem;
        height: 93vh;
    }

    textarea {
        display: none;
    }

    iframe {
        width: 100%;
        height: 29rem;
        border-radius: 0.3rem;
        display: none;
    }

    .recording-indicator-wrapper,
    .h5p-audio-recorder-view .title,
    .h5p-audio-recorder-view [role=status],
    .h5p-content ul.h5p-actions,
    .h5p-audio-recorder-download {
        display: none;
    }

    .h5p-audio-recorder-view .button.retry {
        margin-top: 1rem;
    }

    .return_home {
        display: none;
    }

    .btn-info {
        border-radius: initial;
    }

    #back {
        position: fixed;
        bottom: 0;
        height: 2.5rem;
        border-radius: 0;
    }

    .final_factor {
        margin-top: 4rem;
        padding: 1rem;
        color: #fff;
    }

    #send_time,
    #send_date,
    #payment_type {
        margin-bottom: 0.5rem;
        border-bottom: 1px dashed silver;
        padding: 0.5rem;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
    }

    #send_date {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    #send_date input {
        text-align: center;
        letter-spacing: 0.2rem;
    }

    #send_time input {
        margin-right: 0.5rem;
    }

    .final_factor input {
        color: #3E2723;
    }
</style>