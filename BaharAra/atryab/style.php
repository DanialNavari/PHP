<style>
    .btn-start1 svg {
        display: none;
    }

    datalist {
        display: flex;
        justify-content: space-between;
        color: red;
        width: 100%;
        direction: ltr;
    }

    /* start progress */
    .toolbar-quiz .process-bar-quiz {
        align-items: center;
        display: flex;
        height: 100%;
        margin-left: 16px;
        position: relative;
        width: calc(100% - 240px);
    }

    .toolbar-quiz .process-bar-quiz .bar-gray {
        background: #9d9d9d;
        height: 4px;
        padding: 0;
        position: relative;
        width: 100%;
    }

    .toolbar-quiz .process-bar-quiz .bar-gray .bar-percen {
        background: #2c2c22;
        height: 4px;
        left: 0;
        position: absolute;
        top: 0;
        transition: all 1s;
        width: 100%;
    }

    .toolbar-quiz .process-bar-quiz .list-image {
        display: flex;
        height: 100%;
        justify-content: space-between;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        align-items: center;
    }

    .toolbar-quiz .process-bar-quiz .list-image .step {
        align-items: center;
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: center;
        position: relative;
    }

    .toolbar-quiz .process-bar-quiz .list-image .step .number {
        align-items: center;
        background: #9d9d9d;
        border-radius: 38.0208px;
        color: #f5ecdc;
        display: flex;
        font-size: 12px;
        font-weight: 700;
        height: 2rem;
        justify-content: center;
        line-height: 150%;
        width: 2rem;
        font-family: 'yekan_bold';

    }

    .toolbar-quiz .process-bar-quiz .list-image .step .text {
        bottom: 8px;
        color: #2c2c22;
        font-size: 12px;
        font-weight: 400;
        line-height: 150%;
        position: absolute;
    }

    .toolbar-quiz {
        align-items: center;
        background: #d1d1d1;
        box-shadow: 0 5px 20px hsla(39, 12%, 49%, .3);
        display: flex;
        height: 72px;
        left: 0;
        padding: 0 24px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 2;
        justify-content: center;
        direction: ltr;
    }

    div#age_frame {
        overflow: hidden;
    }

    .noUi-txt-dir-rtl.noUi-horizontal .noUi-handle {
        left: initial;
    }

    .lvl-5 .vasat,
    .lvl-8 .vasat {
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: flex-start;
        gap: 0.6rem;
    }

    .lvl-5 .vasat .form-check,
    .lvl-8 .vasat .form-check {
        padding: 0;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 1rem;
    }

    /* end progress */

    audio {
        display: none;
    }

    button.btn.btn-start1 {
        margin-top: 2rem;
    }

    .pic-bg {
        width: 100vw;
        background: #fff;
        height: 100vh;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .pixel {
        position: absolute;
        top: 20%;
        z-index: 9;
    }

    @media screen and (max-width:320px) {

        #bottle_ {
            width: 51%;
            position: absolute;
            top: 44%;
            box-shadow: none;
            height: fit-content;
            right: 27%;
        }
    }

    @media screen and (max-width: 375px) {

        .process-bar-quiz {
            position: '';
        }

        .toolbar-quiz .process-bar-quiz .list-image .step .number {
            height: 28px;
            width: 28px;
            font-size: 10px;
        }

        .toolbar-quiz {
            display: none;
        }

        .main img {
            height: 5rem;
            width: 5rem;
        }

        .form-check span {
            font-size: 0.7rem;
        }

        #start {
            width: 44%;
            position: absolute;
            right: 28%;
            top: 36%;
            height: 2.2rem;
        }

        #title_ {
            width: 140px;
            position: absolute;
            top: 20%;
            box-shadow: none;
            height: 65px;
        }

        #bottle_ {
            width: 46%;
            position: absolute;
            top: 44%;
            box-shadow: none;
            height: fit-content;
            right: 29%;
        }

        #id_ {
            width: 320px;
            position: absolute;
            top: 66%;
            box-shadow: none;
            height: 150px;
        }
    }

    @media screen and (min-width:376px) and (max-width:768px) {

        .toolbar-quiz .process-bar-quiz .list-image .step .number {
            width: 1.1rem;
            height: 1.1rem;
        }

        .number.n0::before {
            content: '0';
        }

        .toolbar-quiz .process-bar-quiz {
            position: unset;
            width: inherit;
        }

        .toolbar-quiz {
            padding: 0;
            justify-content: normal;
        }

        .main img {
            height: 5rem;
            width: 5rem;
        }

        .form-check span {
            font-size: 0.7rem;
        }

        .pic-bg {
            margin-top: 2rem;
        }

        #start {
            width: 34%;
            position: absolute;
            right: 33%;
            top: 42%;
            height: 2.2rem;
        }

        #title_ {
            width: 140px;
            margin-top: -31vh;
            box-shadow: none;
            height: 65px;
        }

        #bottle_ {
            width: 40%;
            position: absolute;
            top: 44%;
            box-shadow: none;
            height: fit-content;
            right: 32%;
        }

        #id_ {
            width: 320px;
            position: absolute;
            top: 66%;
            box-shadow: none;
            height: 150px;
        }

    }

    @media screen and (min-width:426px) and (max-width:768px) {

        #start {
            width: 20%;
            position: absolute;
            right: 36%;
            top: 43%;
            height: 2.2rem;
        }

        #bottle_ {
            width: 24%;
            position: absolute;
            top: 44%;
            box-shadow: none;
            height: fit-content;
            right: 39%;
        }
    }

    @media screen and (min-width:769px) {

        .number.n0::before {
            content: 'شروع';
        }

        #start {
            width: 15%;
            position: absolute;
            right: 27%;
            top: 43%;
            height: 2.2rem;
        }

        .pic-bg {
            margin-top: 2rem;
        }

        #start {
            width: 14%;
            position: absolute;
            right: 26%;
            top: 40%;
            height: 2.2rem;
        }

        #title_ {
            width: 143px;
            margin-top: -35vh;
            box-shadow: none;
            height: 65px;
        }

        #bottle_ {
            width: 17%;
            position: absolute;
            top: 44%;
            box-shadow: none;
            height: fit-content;
            right: 42%;
        }

        #id_ {
            width: 320px;
            position: absolute;
            top: 66%;
            box-shadow: none;
            height: 150px;
        }


    }

    @media screen and (min-width:1025px) and (max-width:1440px) {
        #title_ {
            width: 15%;
            margin-top: -36vh;
            box-shadow: none;
            height: fit-content;
        }

        #start {
            width: 16%;
            position: absolute;
            right: 19%;
            top: 42%;
            height: 2.2rem;
        }

        #bottle_ {
            width: 18%;
            position: absolute;
            top: 42%;
            box-shadow: none;
            height: 32vh;
            right: 42%;
        }
    }
</style>