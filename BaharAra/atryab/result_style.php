<style>
    .result {
        width: inherit;
        padding: 0;
        margin: 0;
    }

    @media screen and (max-width:425px) {

        .part_1,
        .part_2 {
            flex-direction: column;
        }

        .story_pic {
            width: 100%;
        }

        .story_pic img {
            width: inherit;
        }
    }

    @media screen and (max-width:320px) {
        .result::before {
            content: '';
        }

        .part_2 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            text-align: justify;
        }

        .part2_ {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;
        }

        span#style_name {
            font-size: 1.2rem;
            width: 100%;
            text-align: center;
        }

        .style_smell {
            width: 100%;
        }

        .offer_pic {
            width: 100%;
        }

    }

    @media screen and (min-width:321px) and (max-width:375px) {
        .result::before {
            content: '';
        }

        .style_smell {
            width: 100%;
        }

        .part_2 {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            flex-wrap: nowrap;
            text-align: justify;
        }

        span#style_name {
            text-align: center;
        }

    }

    @media screen and (min-width:376px) and (max-width:425px) {
        .result::before {
            content: '';
        }

        .style_smell {
            width: 100%;
            text-align: center;
        }

        .part2_ {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: flex-start;
            gap: 1rem;
        }

    }

    @media screen and (min-width:426px) and (max-width:768px) {
        .result::before {
            content: '';
        }

        .result {
            padding: 0 5%;
        }

        .part_2 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;

        }

        .style_smell {
            width: 100%;
        }

        .part2_ {
            display: flex;
            gap: 1rem;
            flex-direction: row-reverse;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .offer_pic {
            width: 50%;
            margin: 0 auto;
            height: 100vh;
        }
    }

    @media screen and (min-width:769px) and (max-width:1024px) {
        .result::before {
            content: '';
        }

        .result {
            padding: 0 5%;
        }

        .style_smell {
            width: 100%
        }

        .part_2 {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .part2_ {
            display: flex;
            gap: 1rem;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: row-reverse;
        }

        .offer_pic {
            width: 45%;
            margin: 0 auto;
        }

        .story_pic img,
        .package_image img {
            width: 20rem;
        }

    }

    @media screen and (min-width:1025px) and (max-width:1440px) {
        .result::before {
            content: '';
        }

        .result {
            padding: 0 10%;
        }

        .story_pic img,
        .package_image img {
            width: 24rem;
        }

        .part_2 {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .style_smell {
            width: 100%;
        }

        .part2_ {
            display: flex;
            gap: 1rem;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: row-reverse;
        }

        span#style_desc {
            font-size: 1.2rem;
        }

        .desc {
            font-family: yekan_bold;
            font-size: 1.2rem;
            margin: 1.5rem auto 1rem;
            text-align: right;
        }

        .offer_pic {
            width: 40%;
            margin: 0 auto;
        }
    }

    .main {
        width: 100%;
        margin: 0 auto;
    }

    .part_1,
    .part_2,
    .part__,
    .part_3 {
        width: inherit;
        margin: 0 auto;
        padding: 1rem;
    }

    .tag {
        text-align: justify;
        font-family: 'yekan_bold';
        word-spacing: -0.18rem;
    }

    .tag img {
        width: 3rem;
        height: 3rem;
        box-shadow: none;

    }

    .desc {
        font-family: yekan_bold;
        font-size: 0.9rem;
        padding: 0.5rem;
        margin: 1.5rem auto 1rem;
        text-align: right;
    }

    .desc svg {
        rotate: 0deg;
    }

    div#radif_part2 {
        width: inherit;
        padding: 0;
    }

    iframe {
        border: none;
        width: 100%;
        height: 100vh;
    }


    .title span,
    .smell span,
    .vol span,
    .sl span,
    .fee span,
    .off span {
        font-family: 'Yekan Bakh FaNum';
    }
</style>