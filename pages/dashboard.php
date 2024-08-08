<style scoped>
    /* body {
        background: #000;
    } */

    #YakındaYazı {
        color: green;
        /*color: #8002f5;*/
        font-family: Monaco, monospace;
        font-size: 24px;
        width: 100%;
        text-align: center;
        /* position: absolute; */
        top: 45%;
        left: 0;
        /* animation: 120ms infinite normal yaziyiSallandir; */
        background-color: #000;
    }

    #cursor {
        animation: 1.5s infinite normal imleç;
    }

    ::-moz-selection {
        background: #7021d2;
        color: #fff;
    }

    ::selection {
        background: #7021d2;
        color: #fff;
    }
    .cardDashboard {
        background-color: #000;

    }

    @keyframes yaziyiSallandir {
        0% {
            opacity: 0;
            left: 0;
        }

        40%,
        80% {
            opacity: 1;
            left: -2px;
        }
    }

    @keyframes imleç {
        0% {
            opacity: 0;
            left: 0;
        }

        40% {
            opacity: 0;
            left: -2px;
        }

        80% {
            opacity: 1;
            left: -2px;
        }
    }
</style>

<div oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div class="cardDashboard card p-5">
        <div id="YakındaYazı">█ █ █ <span style="color:black">█ █ █ █ █ █ █ █ █ █ </span>31%
            <br>&gt;
            Hello Visitor
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<br>&gt;
            Dashboard is Coming Soon <span id="cursor">█</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

    </div>

</div>