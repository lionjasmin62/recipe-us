<?php
// ==========================================
// BLOCK 1 OF 3: CONFIGURATION & APPLICATION DATA
// ==========================================

// Parse, sanitize, and intercept active filtering variables from user interaction states
$search_query = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : '';
$category_filter = isset($_GET['category']) ? htmlspecialchars(trim($_GET['category'])) : 'All';

// Extensive structured collection representing the platform's multi-source indexing engine
$recipes = [
    ['title' => 'Creamy Garlic Tuscan Salmon', 'category' => 'Dinner', 'time' => '25 mins', 'rating' => '4.9', 'source' => 'Epicurious', 'desc' => 'Pan-seared salmon in a rich garlic, spinach, and sun-dried tomato cream sauce.'],
    ['title' => 'Authentic Italian Margherita Pizza', 'category' => 'Lunch', 'time' => '40 mins', 'rating' => '4.8', 'source' => 'Serious Eats', 'desc' => 'Classic Neapolitan pizza pizza with fresh mozzarella, basil, and crushed tomatoes.'],
    ['title' => 'Classic Fluffy Buttermilk Pancakes', 'category' => 'Breakfast', 'time' => '15 mins', 'rating' => '4.7', 'source' => 'AllRecipes', 'desc' => 'Golden, thick, and ultra-fluffy pancakes perfect for weekend family brunches.'],
    ['title' => 'Vegan Avocado Quinoa Salad', 'category' => 'Lunch', 'time' => '10 mins', 'rating' => '4.6', 'source' => 'Minimalist Baker', 'desc' => 'Refreshing and nutrient-dense salad tossed in a tangy lemon-herb vinaigrette.'],
    ['title' => 'Slow-Cooker Beef Bourguignon', 'category' => 'Dinner', 'time' => '6 hours', 'rating' => '5.0', 'source' => 'Food Network', 'desc' => 'Tender beef slow-cooked in rich red wine broth with mushrooms, carrots, and herbs.'],
    ['title' => 'Matcha Green Tea Iced Latte', 'category' => 'Drinks', 'time' => '5 mins', 'rating' => '4.5', 'source' => 'Bon Appétit', 'desc' => 'Smooth, earthy ceremonial matcha whisked and poured over cold milk and ice.'],
    ['title' => 'Decadent Molten Chocolate Lava Cake', 'category' => 'Dessert', 'time' => '20 mins', 'rating' => '4.9', 'source' => 'Tasty', 'desc' => 'Rich chocolate cake with an intensely gooey, warm molten chocolate center.'],
    ['title' => 'Crispy Air-Fryer Buffalo Cauliflower', 'category' => 'Snacks', 'time' => '18 mins', 'rating' => '4.4', 'source' => 'SkinnyTaste', 'desc' => 'Spicy, crunchy cauliflower bites tossed in classic tangy buffalo sauce.']
];

$categories = ['All', 'Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Snacks', 'Drinks'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalTaste | Ultimate Recipe Aggregator & Food Network</title>
    <!-- Tailwind CSS Engine Import -->
    <script src="https://tailwindcss.com"></script>
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <!-- PLATFORM HEADER NAVBAR -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="index.php" class="flex items-center space-x-2 text-2xl font-black text-emerald-600 tracking-tight">
                <span>🍽️</span> <span>GlobalTaste</span>
            </a>
            <nav class="hidden md:flex space-x-8 font-medium">
                <button onclick="switchTab('home')" class="text-emerald-600 hover:text-emerald-700">Home</button>
                <button onclick="switchTab('privacy')" class="text-gray-500 hover:text-emerald-600">Privacy Policy</button>
                <button onclick="switchTab('terms')" class="text-gray-500 hover:text-emerald-600">Terms of Service</button>
                <button onclick="switchTab('disclaimer')" class="text-gray-500 hover:text-emerald-600">Disclaimer</button>
            </nav>
            <div class="text-xs bg-gray-100 px-3 py-1.5 rounded-full font-mono text-gray-600">
                Aggregating 500,000+ Recipes
            </div>
        </div>
    </header>

    <main class="flex-grow">
        // ==========================================
        // BLOCK 2 OF 3: DYNAMIC RECIPE HUB (HOME TAB)
        // ==========================================
        ?>
        <div id="tab-home" class="tab-content active">
            <!-- HERO HEADER PATTERN SECTION -->
            <section class="bg-gradient-to-br from-emerald-800 to-teal-950 text-white py-16 px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">Find the Best Recipes from Across the Web</h1>
                    <p class="text-emerald-100 text-lg mb-8">We crawl, index, and organize millions of meals from top food blogs so you don't have to.</p>
                    
                    <form action="index.php" method="GET" class="flex flex-col sm:flex-row gap-2 bg-white p-2 rounded-xl shadow-lg">
                        <input type="text" name="search" value="<?php echo $search_query; ?>" placeholder="Search ingredients, dishes, cuisines..." class="flex-grow px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 font-bold px-8 py-3 rounded-lg transition-colors">Search Recipes</button>
                    </form>
                </div>
            </section>

            <!-- SEGMENTED CATEGORIES OVERFLOW LIST -->
            <section class="max-w-7xl mx-auto px-4 pt-8">
                <div class="flex items-center overflow-x-auto space-x-3 pb-3 scrollbar-hide">
                    <?php 
                    foreach ($categories as $cat) {
                        $activeClass = ($category_filter === $cat) ? 'bg-emerald-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200';
                        echo "<a href='index.php?category={$cat}' class='px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-all shadow-sm {$activeClass}'>{$cat}</a>";
                    }
                    ?>
                </div>
            </section>

            <!-- CARD CONTENT GRID DISPATCHER -->
            <section class="max-w-7xl mx-auto px-4 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                        <?php echo ($category_filter !== 'All') ? "$category_filter Recipes" : "Trending Aggregated Recipes"; ?>
                    </h2>
                    <?php if($search_query): ?>
                        <span class="text-sm bg-emerald-50 text-emerald-700 font-medium px-3 py-1 rounded">Filtered by: "<?php echo $search_query; ?>"</span>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <?php
                    $displayed = 0;
                    foreach ($recipes as $recipe) {
                        if ($search_query && strpos(strtolower($recipe['title']), strtolower($search_query)) === false && strpos(strtolower($recipe['desc']), strtolower($search_query)) === false) continue;
                        if ($category_filter !== 'All' && $recipe['category'] !== $category_filter) continue;
                        $displayed++;
                        ?>
                        <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                            <div class="h-48 bg-emerald-100 flex items-center justify-center relative overflow-hidden">
                                <svg class="absolute inset-0 h-full w-full stroke-emerald-200" fill="none" viewBox="0 0 200 200" preserveAspectRatio="none">
                                    <defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" /></pattern></defs>
                                    <rect width="100%" height="100%" fill="url(#grid)" />
                                </svg>
                                <span class="text-4xl z-10 opacity-80">🍳</span>
                                <span class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold px-2 py-1 rounded">
                                    <?php echo $recipe['source']; ?>
                                </span>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between text-xs text-gray-500 font-semibold uppercase tracking-wider mb-2">
                                        <span><?php echo $recipe['category']; ?></span>
                                        <span class="text-amber-500">★ <?php echo $recipe['rating']; ?></span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-snug line-clamp-2"><?php echo $recipe['title']; ?></h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4"><?php echo $recipe['desc']; ?></p>
                                </div>
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xs text-gray-500 font-medium">⏱️ <?php echo $recipe['time']; ?></span>
                                    <a href="#" onclick="alert('In a live production system, this redirects securely to the original external source.'); return false;" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 inline-flex items-center">
                                        View Recipe <span class="ml-1">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php } 
                    if ($displayed === 0) {
                        echo '<div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-200 p-8"><p class="text-gray-500 font-medium text-lg">No recipes found matching your criteria.</p><a href="index.php" class="text-emerald-600 mt-2 inline-block font-bold">Reset Filters</a></div>';
                    }
                    ?>
                </div>
            </section>
        </div>
        <?php
        // ==========================================
        // BLOCK 3 OF 3: LEGAL COMPLIANCE & FOOTER SYSTEM
        // ==========================================
        ?>
        <!-- PRIVACY MANAGEMENT TAB -->
        <div id="tab-privacy" class="tab-content max-w-4xl mx-auto px-4 py-12">
            <article class="bg-white p-8 md:p-12 rounded-2xl shadow-xs border border-gray-200">
                <h1 class="text-3xl font-extrabold mb-2 text-gray-900">Privacy Policy</h1>
                <p class="text-sm text-gray-500 mb-6">Last Updated: July 14, 2026</p>
                <div class="prose prose-emerald max-w-none text-gray-600 space-y-4">
                    <p>Welcome to GlobalTaste. We are dedicated to respecting your online privacy. This dynamic document outlines our policies regarding the processing, collection, storage, and safe handling of consumer diagnostic data when interacting with our index pipeline.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">1. Information Collection and Tracking</h3>
                    <p>GlobalTaste uses server logging, standard browser cookie mechanics, and localized tracking technologies to enhance user experiences. We collect your Internet Protocol (IP) address, browser definitions, screen resolutions, dynamic search inquiries, and navigation patterns across our aggregate interface panels.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">2. Third-Party Integrations & External Web Crawling</h3>
                    <p>Because GlobalTaste aggregates index data directly from external culinary websites, cookies from third-party networks or recipe hubs may be loaded within your sandbox context if you visit their hyperlinked content. We carry no liability or procedural oversight for data tracking architectures running outside our host server domain node.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">3. Data Retainment Rights</h3>
                    <p>Any account creation profiles, bookmark matrices, or culinary parameter sets built by the consumer remain indexed safely within our secure database layer until deletion is requested under general data protection provisions.</p>
                </div>
            </article>
        </div>

        <!-- TERMS OF USE TAB -->
        <div id="tab-terms" class="tab-content max-w-4xl mx-auto px-4 py-12">
            <article class="bg-white p-8 md:p-12 rounded-2xl shadow-xs border border-gray-200">
                <h1 class="text-3xl font-extrabold mb-2 text-gray-900">Terms of Service</h1>
                <p class="text-sm text-gray-500 mb-6">Last Updated: July 14, 2026</p>
                <div class="prose prose-emerald max-w-none text-gray-600 space-y-4">
                    <p>By browsing, searching, caching, or interacting with the GlobalTaste site index, you explicitly accept and agree to conform to the strict operational mandates listed within this legal document framework.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">1. Platform Scope & Intended Use</h3>
                    <p>GlobalTaste provides automated indexing directories, scraping feeds, and summary pointers linking to user-generated recipes and third-party cooking websites. All materials are presented purely for non-commercial personal reference systems. Unauthorized programmatic extraction, bot scraping, or mirror duplication of this indexed matrix for competitive purposes is strictly illegal.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">2. Fair Use Trademark & Copyright Standards</h3>
                    <p>All aggregated recipe text clips, publisher names, brand logos, and source titles are properties of their respective master copyright holders. GlobalTaste references these properties under global Fair Use provisions for transformational index searching. We do not claim ownership of data fetched via our external query endpoints.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">3. Account Limitation Policies</h3>
                    <p>We preserve full executive rights to filter queries, restrict host access, or throttle IP blocks that demonstrate malicious interface load patterns or script injections against our server layout.</p>
                </div>
            </article>
        </div>

        <!-- COMPLIANCE AND LIABILITY DISCLAIMER TAB -->
        <div id="tab-disclaimer" class="tab-content max-w-4xl mx-auto px-4 py-12">
            <article class="bg-white p-8 md:p-12 rounded-2xl shadow-xs border border-gray-200">
                <h1 class="text-3xl font-extrabold mb-2 text-gray-900">Aggregator Disclaimer Notice</h1>
                <p class="text-sm text-gray-500 mb-6">Last Updated: July 14, 2026</p>
                <div class="prose prose-emerald max-w-none text-gray-600 space-y-4">
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 mb-6 rounded-r">
                        <p class="text-amber-900 font-semibold text-sm">IMPORTANT COMPLIANCE NOTIFICATION:</p>
                        <p class="text-amber-800 text-xs mt-1">Please read this disclaimer completely before executing any cooking steps, handling raw ingredients, or altering nutritional habits based on the index records shown below.</p>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">1. Accuracy of Scraping Output</h3>
                    <p>All information, steps, ingredient weights, oven temperatures, and step sequences displayed here are automatically scraped from third-party networks. GlobalTaste does not screen or verify these lines manually. Errors or parsing drops can happen. Always evaluate ingredient steps with sound culinary judgment before starting food preparation workflows.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">2. Allergens, Dietary Claims, and Medical Health</h3>
                    <p>Nutritional metadata labels (such as "Gluten-Free", "Keto", or "Vegan") are assigned by automation routines or third-party web strings. GlobalTaste cannot guarantee absolute separation from allergens or cross-contamination factors. Consumers with dangerous food sensitivities, celiac disease, or specific dietary health limits must evaluate ingredients directly against physical vendor packaging instead of relying on scraped values.</p>
                    <h3 class="text-xl font-bold text-gray-900 mt-6">3. Safety and Liability</h3>
                    <p>GlobalTaste assumes no administrative liability, financial responsibility, or physical duty for damages, foodborne illnesses, kitchen accidents, fires, or ruined ingredients resulting from reading our aggregated site directory links.</p>
                </div>
            </article>
        </div>
    </main>

    <!-- FOOTER LINK SYSTEM -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h4 class="text-white font-bold text-lg mb-4">🍽️ GlobalTaste Index</h4>
                <p class="text-sm text-slate-400 leading-relaxed">The planet's most advanced programmatic engine gathering food inspirations, culinary blogs, and cooking parameters into a universal search hub.</p>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Explore Cuisines</h4>
                <ul class="text-sm space-y-2">
                    <li><a href="index.php?search=Italian" class="hover:text-white transition-colors">Italian Masterclasses</a></li>
                    <li><a href="index.php?search=Mexican" class="hover:text-white transition-colors">Mexican Street Food</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Legal Operations</h4>
                <ul class="text-sm space-y-2">
                    <li><button onclick="switchTab('privacy')" class="hover:text-white transition-colors block text-left">Privacy Management</button></li>
                    <li><button onclick="switchTab('terms')" class="hover:text-white transition-colors block text-left">Terms of Exploitation</button></li>
                    <li><button onclick="switchTab('disclaimer')" class="hover:text-white transition-colors block text-left">Aggregator Limitation Disclaimer</button></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Database Stats</h4>
                <div class="bg-slate-800 p-4 rounded-xl border border-slate-700 space-y-2 text-xs">
                    <div class="flex justify-between"><span>Active Spiders:</span> <span class="text-emerald-400 font-mono">Online</span></div>
                    <div class="flex justify-between"><span>Indexed Domains:</span> <span class="text-white font-mono">1,420 Blogs</span></div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 border-t border-slate-800 text-center text-xs text-slate-500">
            &copy; 2026 GlobalTaste Indexing Systems Inc. All rights reserved.
        </div>
    </footer>

    <!-- INTERFACE TRANSITION LOGIC -->
    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            const targetTab = document.getElementById('tab-' + tabId);
            if(targetTab) {
                targetTab.classList.add('active');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        <?php if($search_query !== '' || $category_filter !== 'All'): ?>
            switchTab('home');
        <?php endif; ?>
