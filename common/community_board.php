<?php if (isset($posts) && is_array($posts)): ?>
    <section class="p-8 max-w-5xl mx-auto">
        <div class="space-y-6">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-800"> <?= htmlspecialchars($post['title']) ?> </h3>
                    <p class="text-gray-700 mt-2"> <?= htmlspecialchars($post['desc']) ?> </p>
                    <p class="text-gray-500 mt-2 text-sm"> 작성자: <?= htmlspecialchars($post['author']) ?> | <?= htmlspecialchars($post['date']) ?> </p>
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg mt-3">댓글 달기</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>