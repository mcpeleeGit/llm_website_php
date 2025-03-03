<?php if (isset($items) && is_array($items)): ?>
    <section class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
            <?php foreach ($items as $item): ?>
                <div class="bg-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                    <a href="detail.php?title=<?= urlencode($item['title']) ?>">
                        <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>" class="rounded-2xl w-full" />
                    </a>
                    <h3 class="text-2xl font-bold mt-4">
                        <a href="detail.php?title=<?= urlencode($item['title']) ?>" class="text-blue-600 hover:underline">
                            <?= $item['title'] ?>
                        </a>
                    </h3>
                    <p class="text-gray-700"><?= $item['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>