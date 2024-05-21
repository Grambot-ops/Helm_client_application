<footer class="w-full px-4 py-6 text-lg border-t flex flex-wrap justify-between items-center text-white bg-tm-orange">
    <div class="container lg:px-16 mx-auto sm:px-4 flex flex-wrap justify-between w-full">
        <div class="flex flex-wrap w-full md:w-auto">
            <div class="flex flex-wrap w-full md:w-auto text-white">
                <div class="mr-10 mb-2 md:mb-0">
                    <h5 class="text-lg font-bold mb-2">Contact us</h5>
                    <p>Email: info.geel@thomasmore.be</p>
                    <p>Phone: +32 014 72 13 00</p>
                </div>
                <div class="mr-10 mb-2 lg:mr-0 lg:text-left md:mr-0 md:ml-16">
                    <h5 class="text-lg font-bold mb-2">Address</h5>
                    <p>Kleinhoefstraat 4</p>
                    <p>2440 Geel</p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap w-full md:w-auto text-white items-center">
            <div class="mr-10 mb-2 md:mb-0">
                <h5 class="text-lg font-bold mb-2">Team info</h5>
                <p>Group: VCO-A</p>
                <p>Client: Vince Colson</p>
            </div>
        </div>
        <div class="flex flex-wrap w-full md:w-auto text-white items-center">
            <div class="flex flex-col just">
                <h5 class="text-lg font-bold mb-2">Copyright</h5>
                <div class="mb-1 text-white">
                    Thomas More Competition Platform - © {{ date('Y') }}
                </div>
                <div class="flex flex-wrap w-full md:w-auto text-white items-center">
                    {{ $slot ?? '' }}
                </div>
            </div>
        </div>
    </div>
</footer>
