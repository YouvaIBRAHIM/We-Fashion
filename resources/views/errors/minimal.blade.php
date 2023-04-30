<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        @vite(['resources/css/clientStyles.css', 'resources/js/guestApp.js'])

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
                html, body {
                    height: 100%;
                    overflow: hidden; 
                }

                .error-page {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    height: 100%;
                    font-family: Arial,"Helvetica Neue",Helvetica,sans-serif; 
                }
                .error-page h1 {
                    font-size: 30vh;
                    font-weight: bold;
                    position: relative;
                    margin: -8vh 0 0;
                    padding: 0; 
                }
                .error-page h1:after {
                    content: attr(data-h1);
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    color: transparent;
                    /* webkit only for graceful degradation to IE */
                    background: -webkit-repeating-linear-gradient(-45deg, #d8ee76, #80ffd0 , #80ffd0 , #d8ee76, #6bffc8, #6bffc8, #d8ee76 );
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-size: 400%;
                    text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.25);
                    animation: animateTextBackground 10s ease-in-out infinite; 
                }
                .error-page h1 + p {
                    color: #d6d6d6;
                    font-size: 8vh;
                    font-weight: bold;
                    line-height: 10vh;
                    max-width: 600px;
                    position: relative; 
                }
                .error-page h1 + p:after {
                    content: attr(data-p);
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    color: #66EB9A;
                    text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
                    -webkit-background-clip: text;
                    -moz-background-clip: text;
                    background-clip: text; 
                }

                #particles-js {
                    position: fixed;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0; 
                }

                @keyframes animateTextBackground {
                    0% {
                        background-position: 0 0; }
                    25% {
                        background-position: 100% 0; }
                    50% {
                        background-position: 100% 100%; }
                    75% {
                        background-position: 0 100%; }
                    100% {
                        background-position: 0 0; } 
                }

                @media (max-width: 767px) {
                    .error-page h1 {
                        font-size: 32vw; 
                    }
                    .error-page h1 + p {
                        font-size: 8vw;
                        line-height: 10vw;
                        max-width: 70vw; 
                    } 
                }

                a.back {
                    position: fixed;
                    right: 40px;
                    bottom: 40px;
                    background: -webkit-repeating-linear-gradient(-45deg, #6bffc8, #80ffd0 , #b98acc, #ee8176);
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                    color: #fff;
                    font-size: 16px;
                    font-weight: bold;
                    line-height: 24px;
                    padding: 15px 30px;
                    text-decoration: none;
                    transition: 0.25s all ease-in-out; 
                }
                a.back:hover {
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); 
                }
        </style>
    </head>
    <body class="antialiased">
        @include('layouts.guestNavigation')

        <div class="error-page">
            <div>
                <h1 data-h1="@yield('code')">@yield('code')</h1>
                <p data-p="@yield('title')">@yield('title')</p>
            </div>
        </div>
    </body>
</html>
