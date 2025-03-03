<?php
$noodles = [
    [
        "title" => "라멘",
        "image" => "/images/ramen.jpg",
        "desc" => "진한 국물과 쫄깃한 면이 특징입니다.",
        "context" => [
            "기원과 역사" => "라멘은 중국에서 일본으로 전해진 이후, 지역별로 독특한 스타일로 발전했습니다. 현재는 일본의 대표적인 면 요리로 자리 잡았습니다.",
            "주요 스타일" => "쇼유 라멘 (간장), 미소 라멘 (된장), 시오 라멘 (소금), 돈코츠 라멘 (돼지뼈 국물)",
            "어떻게 먹을까" => "라멘은 뜨거운 국물과 함께 면을 빠르게 먹는 것이 특징이며, 마늘, 고추기름, 김 등을 추가할 수 있습니다."
        ]
    ],
    [
        "title" => "우동",
        "image" => "/images/udon.jpg",
        "desc" => "두꺼운 밀가루 면과 깊은 국물.",
        "context" => [
            "기원과 역사" => "우동은 일본에서 가장 오래된 국수 중 하나로, 9세기경 중국에서 전해졌다고 전해집니다.",
            "주요 스타일" => "가케우동 (뜨거운 국물), 자루우동 (차가운 면), 나베야키우동 (전골 스타일)",
            "어떻게 먹을까" => "국물에 적셔 먹거나, 차갑게 찍어 먹는 방식이 있습니다."
        ]
    ]
];

$recipes = [
    [
        "title" => "라멘 레시피",
        "image" => "/images/ramen_recipe.jpg",
        "desc" => "집에서 만드는 일본식 라멘.",
        "context" => [
            "재료" => "라멘 면, 돼지고기 차슈, 삶은 달걀, 대파, 간장, 미소, 다시마, 멸치 육수, 참기름, 고추기름",
            "조리 방법" => "1. 냄비에 육수를 끓이고 다시마를 넣는다.\n2. 간장과 미소를 풀어 국물 맛을 조절한다.\n3. 라멘 면을 삶아 헹군 후 그릇에 담는다.\n4. 육수를 붓고 차슈, 계란, 대파를 올린다.\n5. 참기름과 고추기름을 뿌려 완성한다."
        ]
    ],
    [
        "title" => "우동 레시피",
        "image" => "/images/udon_recipe.jpg",
        "desc" => "간단한 재료로 따뜻한 우동 만들기.",
        "context" => [
            "재료" => "우동 면, 다시마, 가쓰오부시, 간장, 설탕, 미림, 대파, 튀김가루",
            "조리 방법" => "1. 다시마와 가쓰오부시로 국물을 만든다.\n2. 간장, 설탕, 미림을 넣고 간을 맞춘다.\n3. 우동 면을 삶아 국물에 담는다.\n4. 대파와 튀김을 올려 완성한다."
        ]
    ]
];

$restaurants = [
    [
        "title" => "라멘 명가",
        "image" => "/images/ramen_shop.jpg",
        "desc" => "진한 돈코츠 국물이 유명한 일본식 라멘 전문점.",
        "context" => [
            "위치" => "서울시 강남구 국수로 123",
            "영업시간" => "매일 11:00 - 22:00 (월요일 휴무)",
            "대표 메뉴" => "돈코츠 라멘 (12,000원), 미소 라멘 (11,000원), 시오 라멘 (10,000원)",
            "리뷰" => "국물이 정말 진하고 깊은 맛이 납니다. 면도 탱탱하고 너무 맛있어요!"
        ]
    ],
    [
        "title" => "우동 한그릇",
        "image" => "/images/udon_shop.jpg",
        "desc" => "쫄깃한 면발과 깊은 국물 맛이 일품.",
        "context" => [
            "위치" => "서울시 종로구 우동길 45",
            "영업시간" => "매일 10:30 - 21:00",
            "대표 메뉴" => "가케 우동 (8,000원), 튀김 우동 (10,000원), 나베야키 우동 (12,000원)",
            "리뷰" => "일본에서 먹었던 우동 맛 그대로! 국물이 정말 시원하고 면발이 탱탱해요."
        ]
    ],
    [
        "title" => "베트남 쌀국수",
        "image" => "/images/pho_shop.jpg",
        "desc" => "신선한 허브와 깊은 육수의 조화.",
        "context" => [
            "위치" => "서울시 마포구 쌀국수길 89",
            "영업시간" => "매일 11:00 - 23:00",
            "대표 메뉴" => "소고기 쌀국수 (10,000원), 해산물 쌀국수 (12,000원), 분짜 (13,000원)",
            "리뷰" => "고수 향이 강하지 않고 국물이 진해서 한국인 입맛에도 딱 맞아요!"
        ]
    ]
];

// 모든 데이터를 하나의 배열로 합침
$all_items = array_merge($noodles, $recipes, $restaurants);
