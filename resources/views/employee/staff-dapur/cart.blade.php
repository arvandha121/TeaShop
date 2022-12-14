<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>


<body style="background-color: #d8d4dc;">
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg  md:max-w-5xl">
            <div class="md:flex ">
                <div class="w-full p-4 px-5 py-5">
                    <div class="md:grid md:grid-cols-12 gap-2 ">
                        <div class="col-span-12 p-5">
                            <button class="btn px-3 py-1"
                                style="color: #ffbe33; background-color:#202c34; border-radius: 15px; margin-left:85%;">
                                <a class="text-md font-medium mr-2" style="color: #ffbe33;"
                                    href="../../product/index.php">Kembali
                                </a>
                                <i class="fa fa-arrow-right text-sm pr-2"></i>
                            </button>
                            <h1 class="text-xl font-bold text-gray-800">Shopping Cart</h1>
                            <div class="flex justify-between items-center mt-6 pt-3">
                                <div class="flex  items-center">
                                </div>
                                <div class="flex justify-center items-center">
                                    <div class="pr-8 ">
                                        <span class="text-lg font-medium text-gray-800 font-bold">Subtotal</span>
                                    </div>
                                </div>
                            </div>

                            <div id="items">

                            </div>

                            <form action="payment.php" method="post">
                                <div class="flex justify-between items-center mt-3 pt-3">
                                    <button class="btn px-5 py-1 text-lg font-bold" type="submit" name="bayarchart"
                                        style="color: #ffbe33; background-color:#ffbe33; color: #202c34; border-radius: 15px;">Bayar
                                        Sekarang
                                    </button>
                                    <div class="flex justify-center items-end mr-5">
                                        <span class="text-lg font-medium text-gray-800 mr-3">Total : </span>
                                        <span class="text-lg font-bold text-gray-800"> Rp
                                            333,-
                                        </span>
                                        <input type="hidden" name="total" value="333">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
