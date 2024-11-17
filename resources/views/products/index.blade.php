<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
        function filterProducts() {
            const searchTerm = document.getElementById('search').value.trim().toLowerCase();
            const productElements = document.querySelectorAll('.product-item');
            
            productElements.forEach(product => {
                const productName = product.querySelector('.product-name').innerText.toLowerCase();
                let productPrice = product.querySelector('.product-price').innerText.replace('$', '').trim(); // Remove "$" from the price

                if (productPrice.includes('.00')) {
                    productPrice = productPrice.split('.')[0]; 
                 }

                let matchesName = productName.includes(searchTerm);
                let matchesPrice = false;

                if (!isNaN(searchTerm) && searchTerm !== '') {
                    if (productPrice === searchTerm) {
                        matchesPrice = true;
                    }
                }

                 if (matchesName || matchesPrice) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }


    </script>
    <style type="text/tailwindcss">


        @layer base {
				:root {
					--background: 0 0% 100%;
--foreground: 222.2 84% 4.9%;
--card: 0 0% 100%;
--card-foreground: 222.2 84% 4.9%;
--popover: 0 0% 100%;
--popover-foreground: 222.2 84% 4.9%;
--primary: 222.2 47.4% 11.2%;
--primary-foreground: 210 40% 98%;
--secondary: 210 40% 96.1%;
--secondary-foreground: 222.2 47.4% 11.2%;
--muted: 210 40% 96.1%;
--muted-foreground: 215.4 16.3% 46.9%;
--accent: 210 40% 96.1%;
--accent-foreground: 222.2 47.4% 11.2%;
--destructive: 0 84.2% 60.2%;
--destructive-foreground: 210 40% 98%;
--border: 214.3 31.8% 91.4%;
--input: 214.3 31.8% 91.4%;
--ring: 222.2 84% 4.9%;
--radius: 0.5rem;
				}
				
			}
    </style>
</head>

<body>


    <div class="sticky top-0 z-10 bg-white">
        <header class="p-4">
            <div class="bg-primary rounded-lg shadow-lg p-6 flex justify-between items-center w-full ">
                <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center">
                    <span class="text-2xl font-bold text-primary">N<sup>2</sup></span>
                </div>
                <div class="pt-4 pb-4 px-4">
                    <input type="text" id="search" oninput="filterProducts()" placeholder="Search for products..."
                        class="border border-gray-300 rounded-lg p-2 pl-4 ml-14 w-[450px]" />
                </div>
                <a href="{{ route('products.create') }}"
                    class="bg-secondary text-secondary-foreground px-4 py-2 rounded-lg">add product</a>
            </div>
        </header>
    </div>

    <div class="bg-background pt-0 pb-4 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-15">
            @foreach ($products as $product)
                <div class="product-item bg-card rounded-lg shadow-lg p-4 flex flex-col">
                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image"
                        class="rounded-lg w-[485px] h-[380px]" />
                    <div class="flex justify-between items-center mt-4">
                        <h2 class="font-bold text-3xl uppercase product-name">{{ $product->name }}</h2>
                        <p class="text-muted-foreground text-2xl product-price">${{ $product->price }}</p>
                    </div>
                    <p class="text-muted-foreground">
                        {{ \Str::words($product->description, 4) }}
                    </p>
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="bg-accent text-accent-foreground px-3 py-1 rounded w-full text-center">View</a>
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="bg-primary text-primary-foreground px-3 py-1 rounded w-full text-center">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            style="display:inline; flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-black text-white px-3 py-1 rounded w-full text-center">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>