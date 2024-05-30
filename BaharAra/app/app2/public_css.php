<style>
    .header {
        z-index: 1;
    }

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
        margin-bottom: 0.5rem;
        padding: 0.5rem;
    }

    h6#t {
        color: chartreuse;
    }

    h6#m {
        color: #ffeb00;
    }

    #ttarget td {
        padding: 0.5rem;
    }

    .t_right {
        text-align: right;
    }

    .t_left {
        text-align: left;
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
        width: 100%;
        height: 70vh;
        margin: 6rem auto;
    }

    .full_screen {
        height: 100vh;
        width: 100%;
        overflow: hidden;
        display: none;
        background: #fff;
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
        bottom: 26.2rem;
        right: 0;
    }

    #final_pay_btn,
    #show_basket,
    #return_cat,
    #final_save {
        height: 2.5rem;
        margin-left: 0.5rem;
        width: 6rem;
        font-size: 0.8rem;
    }

    .final_pay_btn {
        display: none;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        align-items: flex-start;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
        margin: 0 auto;
        background: #525254;
        padding: 0.4rem;
        position: fixed;
        bottom: 0rem;
        right: 0;
        height: 15vh
    }

    .bg_pic {
        background-position: center center;
        background-size: 2rem 3rem;
        background-repeat: repeat-y;
    }

    ul {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-evenly;
        align-items: stretch;
        flex-wrap: nowrap;
    }

    li.nav-item {
        margin-left: 0.5rem;
        margin-right: 0.5rem;
        border: 1px dashed silver;
        border-top: none;
        border-bottom: none;
        border-left: none;
        padding-right: 0.5rem;
    }

    .final {
        display: none;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        margin: 12vh auto 0;
        color: #fff;
        overflow: hidden;
        background: #6abf11;
        position: relative;
        right: 0;
        padding: 1rem;
        border-radius: 1rem;
        box-shadow: 1px 1px 8px 2px #fff;
        border: none;
        top: 10vh;
        width: 80vw;
        text-align: center;
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
        z-index: 1;
        top: 3.5rem;
        overflow: auto;
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

    .final_icon {
        color: #fff;
    }

    .final_link {
        font-size: 0.8rem;
        text-align: center;
        padding: 0.5rem;
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

    .abstract_factor {
        position: fixed;
        top: 3rem;
        width: 100%;
        background: #525254;
        box-shadow: 0 0 5px #fff;
        z-index: 1;
    }

    .abstract_factor table {
        margin: 0 auto;
        width: 90%;
        text-align: center;
        color: #fff;
    }

    .abstract_factor td {
        width: calc(100vw/3);
        text-align: center;
        border-left: 1px dashed silver;
        padding: 0.3rem;
    }

    .abstract_factor th {
        padding: 0.3rem;
        border-bottom: 1px dashed silver;
    }

    #all_prod {
        margin-top: 8rem;
        margin-bottom: 8rem;
    }

    #all_prod div {
        text-align: center;
        width: 100%;
        border-bottom: 1px dashed silver;
    }

    .bg_pic {
        background-position: center;
        /* width: 17vw; */
        height: 10vh;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        background-size: cover;
        color: red;
        opacity: 0.9;
        border-radius: 50%;
        border: 1px dashed silver;
    }

    div#update {
        margin: 13vh auto;
        text-align: center;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 1rem;
    }

    .upd_link a {
        color: #000;
        font-size: unset;
        background: #fff;
        padding: 1rem;
        border-radius: 0.3rem;
        box-shadow: 0 0 8px 2px #fff;
    }

    .upd_link {
        margin-top: 2rem;
    }

    #tasviye {
        font-size: 0.8rem;
    }

    div#factor_extra_less {
        margin-top: 1rem;
        border-top: 1px dashed silver;
        padding: 0.4rem;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .final_factor {
        margin-top: 4rem;
        padding: 1rem;
        color: #fff;
        height: 90vh;
    }
</style>