<div>
    <style>
        .section {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #ddd;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            flex: 1;

            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            color: black;
            text-align: center;
            transition: all 0.3s ease;
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .profit-box {
            background: gold;
        }

        .profit-box.negative {
            background: rgb(241, 105, 105);
        }

        /* date */
        .date-range-container {
            display: flex;
            /* Arrange labels and inputs horizontally */
            align-items: center;
            /* Vertically align labels with inputs */
            margin-bottom: 1rem;
            /* Add some spacing below the date range */
        }

        .date-range-container label {
            margin-right: 1rem;
            /* Space between label and input */
            font-weight: bold;
            /* Emphasize labels */
        }

        .date-range-container input[type="date"] {
            padding: 0.5rem 1rem;
            /* Adjust padding for a balanced look */
            border: 1px solid #ccc;
            /* Basic border */
            border-radius: 4px;
            /* Rounded corners */
        }

        /* display graph */
        @media screen and (max-width: 811px) {
            .category-chart {
                display: none !important;
            }

            .brand-chart {
                display: none !important;
            }
        }
    </style>
    <div class="date-range-container">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" wire:model.live="startDate">

        <label for="endDate" class="m-3">End Date:</label>
        <input type="date" id="endDate" name="endDate" wire:model.live="endDate">
    </div>

    <div class="container">
        <div class="box">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Revenue</p>
                    <h6 class="mb-0">{{ $totalAmountRevenue }}$</h6>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Expense</p>
                    <h6 class="mb-0">{{ $totalAmountExpense }}$</h6>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="rounded d-flex align-items-center justify-content-between p-4"
                style="background: {{ $totalAmountProfit < 0 ? 'rgb(241, 105, 105)' : 'rgb(181, 249, 178)' }};">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Profits</p>
                    <h6 class="mb-0">{{ $totalAmountProfit }}$</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-user"></i>
                <div class="ms-3">
                    <p class="mb-2">Total User</p>
                    <h6 class="mb-0">{{ $totalUser }}</h6>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-brands fa-product-hunt"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Product</p>
                    <h6 class="mb-0">{{ $totalProduct }}</h6>
                </div>
            </div>
        </div>

        <div class="box" >
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-warehouse"></i>
                <div class="ms-3">
                    <p class="mb-2">Number of Products with Quantity >0</p>
                    <h6 class="mb-0">{{ $productCount }}</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- PRODUCT COUNT  --}}
    <div>

        <!-- Display quantities by brand -->
        <div class="section">
            <h2>Quantities by Brand</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quantitiesByBrand as $quantity)
                        <tr>
                            <td>{{ $quantity->productbrand->brand }}</td>
                            <td>{{ $quantity->total_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Display quantities by category -->
        <div class="section">
            <h2>Quantities by Category</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quantitiesByCategory as $quantity)
                        <tr>
                            <td>{{ $quantity->productcategory->category_name }}</td>
                            <td>{{ $quantity->total_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- GRAPH --}}

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Render your charts here using JavaScript -->
        <div class="brand-chart" wire:ignore
            style="display: flex; justify-content: center; align-items: center; height: 50vh; margin: 90px;">
            <div>
                <h2 style="font-size: 40px">Brand Quantity Chart</h2>
                <canvas id="brandChart" style="height: 400px !important"></canvas>
            </div>
        </div>
        {{-- <h2 style="font-size: 40px" >Category Quantity Chart</h2>
        <canvas id="categoryChart"style="height: 400px !important"></canvas> --}}
        <div class="category-chart" wire:ignore
            style="display: flex; justify-content: center; align-items: center; height: 50vh;">
            <div>
                <h2 style="font-size: 40px">Category Quantity Chart</h2>
                <canvas id="categoryChart" style="height: 400px !important"></canvas>
            </div>
        </div>


        <script>
            var brandData = @json($quantitiesByBrand);
            var categoryData = @json($quantitiesByCategory);

            // Function to generate a random color in hexadecimal format
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Use brandData and categoryData to create Chart.js charts
            // Example:
            var brandChart = new Chart(document.getElementById('brandChart'), {
                type: 'pie',
                data: {
                    labels: brandData.map(data => data.productbrand.brand),
                    datasets: [{
                        label: 'Total Quantity by Brand',
                        data: brandData.map(data => data.total_quantity),
                        backgroundColor: brandData.map(() =>
                            getRandomColor()), // Generate random color for each dataset
                        borderColor: brandData.map(() => getRandomColor()), // Border color can also be random
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false
                }
            });


            // Function to generate random RGB color
            function randomColor() {
                const r = Math.floor(Math.random() * 256);
                const g = Math.floor(Math.random() * 256);
                const b = Math.floor(Math.random() * 256);
                return `rgba(${r}, ${g}, ${b}, 0.2)`;
            }

            // Create the chart with random colors
            var categoryChart = new Chart(document.getElementById('categoryChart'), {
                type: 'bar',
                data: {
                    labels: categoryData.map(data => data.productcategory.category_name),
                    datasets: [{
                        label: 'Total Quantity by Category',
                        data: categoryData.map(data => data.total_quantity),
                        backgroundColor: categoryData.map(() => randomColor()), // Generate random colors
                        borderColor: categoryData.map(() =>
                            randomColor()), // Use the same random colors for border
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false
                }
            });
        </script>

    </div>
