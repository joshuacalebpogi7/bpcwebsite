<x-admin-manage-layout :user="$user">
    @livewire('admin-edit-admin-profile', ['user' => $user])
    @push('styles')
        <style>
            .screen {
                z-index: 100;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                /* background: #f2f6fc9a; */
                /* background: #f0f0e1; */
                background: rgb(102, 107, 22);
                background: -moz-linear-gradient(0deg, rgba(102, 107, 22, 0.7511379551820728) 0%, rgba(142, 138, 42, 0.5578606442577031) 36%, rgba(255, 244, 0, 0.17130602240896353) 100%);
                background: -webkit-linear-gradient(0deg, rgba(102, 107, 22, 0.7511379551820728) 0%, rgba(142, 138, 42, 0.5578606442577031) 36%, rgba(255, 244, 0, 0.17130602240896353) 100%);
                background: linear-gradient(0deg, rgba(102, 107, 22, 0.7511379551820728) 0%, rgba(142, 138, 42, 0.5578606442577031) 36%, rgba(255, 244, 0, 0.17130602240896353) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#666b16", endColorstr="#fff400", GradientType=1);
                display: flex;
                align-items: center;
            }

            .loader {
                width: 100%;
                /* height: 15px; */
                text-align: center;
            }

            .scene {
                position: relative;
                display: block;
                margin: 0 auto;
                width: 300px;
                height: 200px;
            }

            .plane,
            .cloud {
                position: absolute;
            }

            /*plane animation*/
            .plane {
                animation-duration: 1s;
                animation-name: anim-plane;
                animation-iteration-count: infinite;
                animation-direction: alternate;
                animation-timing-function: linear;

                animation-fill-mode: forwards;
                display: block;
                margin: 0 auto;
                transform: translateY(80px);
                left: 30%;
            }

            @keyframes anim-plane {
                to {
                    transform: translateY(95px);
                }
            }


            /* Cloud Animation */

            @keyframes fade {
                0% {
                    opacity: 0;
                }

                10% {
                    opacity: 1;
                }

                90% {
                    opacity: 1;
                }

                100% {
                    opacity: 0;
                }
            }

            @keyframes move {
                from {
                    left: 200px;
                }

                to {
                    left: 0px;
                }
            }


            .cloud {
                animation-duration: 10s;
                animation-name: move, fade;
                animation-direction: normal;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
                animation-fill-mode: both;

                display: block;
                background: url(data:image/svg+xml;base64,PHN2ZyBpZD0iY2xvdWQiIHZpZXdCb3g9IjAgMCA1MiA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSI1MnB4IiBoZWlnaHQ9IjQwcHgiPgoJPGRlZnM+CgkJPGZpbHRlciBpZD0iZjEiIHg9Ii0xMDAlIiB5PSItMTAwJSIgd2lkdGg9IjMwMCUiIGhlaWdodD0iMzAwJSI+IAoJCQk8ZmVPZmZzZXQgcmVzdWx0PSJvdXQiIGluPSJTb3VyY2VHcmFwaGljIiBkeD0iMCIgZHk9IjEiLz4KCQkJPGZlQ29sb3JNYXRyaXggcmVzdWx0PSJvdXQiIGluPSJvdXQiIHR5cGU9Im1hdHJpeCIgdmFsdWVzPSIwIDAgMCAwIDAgIDAgMCAwIDAgMCAgMCAwIDAgMCAwICAwIDAgMCAwLjQgMCIvPgoJCQk8ZmVHYXVzc2lhbkJsdXIgcmVzdWx0PSJvdXQiIGluPSJvdXQiIHN0ZERldmlhdGlvbj0iMiIvPgoJCQk8ZmVCbGVuZCBpbj0iU291cmNlR3JhcGhpYyIgaW4yPSJvdXQiIG1vZGU9Im5vcm1hbCIgcmVzdWx0PSJkcCIvPgoJCTwvZmlsdGVyPgoJPC9kZWZzPiAKCTxwYXRoIGlkPSJmZy1jbG91ZCIgZmlsdGVyPSJ1cmwoI2YxKSIgZD0iTTYuMyAzNS4xQzQuNyAzNC4yLTAuNCAzMi4zIDEuNCAyNSAzLjEgMTguMSA4LjcgMTkuNSA4LjcgMTkuNSA4LjcgMTkuNSAzLjIgMTQuMSAxMC40IDYuOCAxNi45IDAuMiAyMy4xIDQuNiAyMy4xIDQuNiAyMy4xIDQuNiAzMC0xLjcgMzUuMiAyLjQgNDQuNiA5LjcgNDIuOCAyNS4zIDQyLjggMjUuMyA0Mi44IDI1LjMgNDggMjIuNiA0OS44IDI4LjYgNTEgMzIuNyA0NiAzNS44IDQyLjggMzYuNyAzOS43IDM3LjUgOC45IDM2LjYgNi4zIDM1LjFaIiBzdHJva2U9IiNjY2NjY2MiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0iI2ZmZmZmZiIvPgo8L3N2Zz4=);
                height: 40px;
                width: 53px;
                margin: 0 auto;
            }

            .cloud--small {
                animation-duration: 6s;
                top: 65px;
                transform: scaleX(0.5) scaleY(0.5);
            }

            .cloud--medium {
                animation-duration: 5s;
                animation-delay: 1s;
                top: 95px;
                transform: scaleX(0.7) scaleY(0.7);
            }

            .cloud--large {
                animation-duration: 4.5s;
                animation-delay: 2.5s;
                top: 95px;
                transform: scaleX(0.8) scaleY(0.8);
            }

            .whoami {
                padding-top: 3em;
                text-align: center;
            }
        </style>
    @endpush
</x-admin-manage-layout>
