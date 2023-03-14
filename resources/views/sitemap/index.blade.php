
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        {{-- {{ url('/') }}/post/{{ $post->{'slug_' . app()->getLocale()} }} --}}

        <url>
            <loc>{{ url('/') }}/post.single/{{ $post->{'slug_' . app()->getLocale()} . '/' . $post->id }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
