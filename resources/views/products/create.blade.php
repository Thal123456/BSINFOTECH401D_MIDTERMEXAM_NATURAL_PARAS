<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        document.addEventListener("DOMContentLoaded", () => {
            const fileInput = document.getElementById("image");
            const progressBar = document.getElementById("progress-bar");
            const progressLabel = document.getElementById("progress-label");
            const fileName = document.getElementById("file-name");
            const submitButton = document.querySelector("button[type='submit']");

            fileInput.addEventListener("change", function () {
                const file = fileInput.files[0];
                if (file) {
                    progressBar.parentElement.classList.remove("hidden");
                    fileName.textContent = file.name;

                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 20;
                        progressBar.style.width = `${progress}%`;
                        progressLabel.textContent = `${progress}%`;

                        if (progress >= 100) {
                            clearInterval(interval);
                            submitButton.disabled = false;
                        }
                    }, 500);

                    submitButton.disabled = true;
                }
            });
        });

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
        .dark {
          --background: 222.2 84% 4.9%;
          --foreground: 210 40% 98%;
          --card: 222.2 84% 4.9%;
          --card-foreground: 210 40% 98%;
          --popover: 222.2 84% 4.9%;
          --popover-foreground: 210 40% 98%;
          --primary: 210 40% 98%;
          --primary-foreground: 222.2 47.4% 11.2%;
          --secondary: 217.2 32.6% 17.5%;
          --secondary-foreground: 210 40% 98%;
          --muted: 217.2 32.6% 17.5%;
          --muted-foreground: 215 20.2% 65.1%;
          --accent: 217.2 32.6% 17.5%;
          --accent-foreground: 210 40% 98%;
          --destructive: 0 62.8% 30.6%;
          --destructive-foreground: 210 40% 98%;
          --border: 217.2 32.6% 17.5%;
          --input: 217.2 32.6% 17.5%;
          --ring: 212.7 26.8% 83.9;
        }
      }

      .progress-bar-container {
            width: 100%;
            height: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin-top: 10px;
            visibility: visible;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background-color: #4caf50;
            border-radius: 5px;
            transition: width 0.5s ease;
        }
    </style>
</head>

<body class="min-h-screen bg-primary flex items-center justify-center">
    <div class="w-full flex flex-col items-center">

        <div class="bg-card p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold text-foreground mb-4 text-center">NEW PRODUCT</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 flex flex-wrap">
                    <div class="w-full md:w-1/2 md:pr-2">
                        <label class="block text-muted-foreground" for="name">Name</label>
                        <input class="border border-muted rounded-lg p-2 w-full" type="text" id="name" name="name"
                            placeholder="Enter product name" required />
                    </div>
                    <div class="w-full md:w-1/2 md:pl-2">
                        <label class="block text-muted-foreground" for="price">Price</label>
                        <input class="border border-muted rounded-lg p-2 w-full" type="text" id="price" name="price"
                            placeholder="Enter product price" />
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-muted-foreground" for="description">Description</label>
                    <textarea class="border border-muted rounded-lg p-2 w-full" id="description" name="description"
                        placeholder="Enter product description"></textarea>
                </div>
                <div class="mb-4 flex justify-center">
                    <label for="image"
                        class="cursor-pointer bg-secondary text-secondary-foreground hover:bg-secondary/80 w-full p-2 rounded-lg text-center">
                        Choose a file
                    </label>
                    <input type="file" id="image" name="image" class="hidden" required />

                </div>
                <div class="mb-4">
                    <div class="progress-bar-container hidden">
                        <div class="progress-bar" id="progress-bar"></div>
                    </div>
                    <div class="mt-2">
                        <span id="file-name" class="text-muted-foreground"></span>
                    </div>
                    <div id="progress-label" class="mt-2 text-muted-foreground hidden">0%</div>

                </div>

                <div>
                    <button type="submit"
                        class="bg-primary text-primary-foreground hover:bg-primary/80 w-full p-2 rounded-lg">Save</button>
                </div>
            </form>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('products.index') }}" class="text-white hover:text-white/80">Back to List</a>
        </div>
    </div>
</body>

</html>