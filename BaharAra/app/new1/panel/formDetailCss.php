<style>
    @font-face {
        font-family: 'english';
        src: url(../font/EbbingPersonalUseOnly-maK9.ttf);
    }

    html,
    body {
        background-color: #fff;
        direction: rtl;
    }

    .info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .header {
        border: 1px solid silver;
        background-color: transparent;
        color: #000;
        margin: 0.5rem auto;
        width: 100%;
        border-radius: 0.4rem;
        position: relative;
    }

    .header td.border_left {
        border: 1px solid silver;
        width: 25%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .header td.border_right {
        border: 1px solid silver;
        width: 25%;
        text-align: right;
        border-right: none;
        border-top: none;
        border-bottom: none;
        padding-right: 1rem;
    }

    .header img {
        width: 5rem;
        vertical-align: middle;
        filter: grayscale(1);
    }

    th {
        text-align: right;
        padding: 0rem;
        font-size: 0.8rem;
    }

    .factor_row td {
        padding: 0.2rem;
        border: 1px solid silver;
        text-align: center;
        font-size: 0.8rem;
    }

    .factor_row1 td {
        padding: 1rem;
        text-align: center;
        font-size: 0.8rem;
    }

    #map {
        border-radius: 1rem;
        box-shadow: 1px 1px 5px #8f8f8f;
        filter: brightness(1) contrast(1) grayscale(1) saturate(1) invert(1);
        width: 100%;
    }

    .english {
        font-size: 1.2rem;
        font-weight: 600;
        background: #212121;
        color: #fff;
        width: 20%;
        margin: 0 auto;
        padding: 0.2rem;
        border-radius: 0.3rem;
    }

    td {
        font-size: 0.9rem;
        padding: 0.3rem;
        border: 1px dashed silver;
        border-radius: 0.4rem;
        text-align: center;
    }

    .watermark {
        color: #e1e1e166;
        font-family: b titr;
        font-size: 4rem;
        rotate: -20deg;
        position: absolute;
        margin: 9rem auto 0px;
        z-index: 99;
        width: 100%;
        text-align: center;
        padding-top: 1rem;
    }

    .logos {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }

    .signs img {
        width: 7vw;
        filter: grayscale(1);
        height: 12vh;
    }

    .signs {
        width: 15vw;
        height: 15vh;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 0.3rem;
    }

    .free_sign {
        height: 15vh;
    }

    #seller_pic {
        outline: none;
        border: none;
        filter: brightness(1) contrast(1) grayscale(1);
        border-radius: 0.5rem;
        margin-left: 1rem;
        padding: 0.15rem;
        margin-right: 1rem;
    }

    .btn {
        cursor: pointer;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn:hover {
        box-shadow: 0 0 3px 1px #000;
    }


    .signs_btn {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
        gap: 1rem;
    }

    .supervisor_ok,
    .manager_ok,
    .admin_ok,
    .accountant_ok {
        background: #AED581;
    }

    #supervisor,
    #manager,
    #admin _img {
        display: none;
    }

    td.sign_date {
        border: none;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
    }

    .shaba {
        border: none;
    }

    .english {
        padding: 0.4rem;
    }

    .logos img {
        width: 3rem;
        height: auto;
        border-radius: 20%;
    }

    @media print {
        .signs_btn {
            display: none;
        }

        .signs {
            gap: 0;
            height: 10vh;
        }

        .signs img {
            width: 8vw;
            height: 8vh;
        }

        #manager_del,
        #super_del {
            display: none;
        }

        .english {
            padding: 0.4rem;
        }

        .logos img {
            width: 3rem;
            height: auto;
        }
    }

    #map_pic {
        width: 9rem;
        height: 8rem;
        border-top-left-radius: 0.6rem;
        border-bottom-right-radius: 0.6rem;
        box-shadow: 0 0 3px #161515;
    }

    #tarikh_saat h4 {
        margin-bottom: 0.4rem;
    }

    .svg_ok {
        background: #004D40;
        opacity: 1;
    }

    .svg_no {
        background: #B71C1C;
        opacity: 1;
    }

    .okcancel div svg {
        width: 2rem;
        cursor: pointer;
        height: 2rem;
        box-shadow: 0px 0px 5px 1px silver;
        padding: 0.2rem;
        border-radius: 50%;
    }

    .okcancel div {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        align-items: center;
        margin: 1rem auto;
    }

    .okcancel {
        width: 8rem;
    }
</style>

<style>
    .tester_code {
        width: 100%;
        background: #e0e0e0;
        color: #000;
        padding: 0.05rem;
        text-align: center;
        display: block;
        margin-bottom: -1rem;
    }

    .btn-danger {
        width: 100%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0.5rem;
        background: #F44336;
    }

    .manager_accept {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        gap: 1rem;
    }

    #super_del {
        display: none;
    }

    .mohr img {
        height: inherit;
        width: inherit;
    }

    .mohr {
        display: none;
    }

    @media print {
        .no_print {
            display: none;
        }

        .mohr {
            width: 6rem;
            position: absolute;
            bottom: 0vh;
            left: 0vw;
            opacity: 1;
            z-index: -1;
            filter: grayscale(1) brightness(1);
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: stretch;
        }
    }

    .zarinpal_pos {
        background-color: #000;
        color: #fff;
        text-align: center;
    }

    span#factor_desc {
        background: #000;
        color: #fff;
        padding: 0.3rem;
        border-radius: 0.3rem;
    }

    .factor_detail {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 18rem;
        font-size: 0.9rem;
        margin: 0.3rem auto;
        background: transparent;
        padding: 0.4rem;
        border-radius: 0.4rem;
        border: 1px dashed silver;
    }

    .sign {
        width: 5rem;
        height: 5rem;
    }

    /*     .emza td {
        height: 5rem;
    }

    .emza tr:nth-child(1) {
        display: none;
    } */

    .info1 {
        font-size: 0.9rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        width: inherit;
        justify-content: flex-start;
        gap: 4rem;
    }

    .masir {
        display: flex;
        flex-direction: column;
        gap: 0rem;
        align-items: flex-start;
    }

    .factor_detail.masir {
        gap: 0.5rem;
    }
</style>