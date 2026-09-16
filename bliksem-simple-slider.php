<?php
/**
 * Plugin Name: ananchoredfaith
 * Description: Drop [af_hero_slider] on your homepage. Done.
 * Version:     4.0.0
 * Author: Ferrin Mutuku
 * Author URI:       https://github.com/Ferinmtk
 * License:     GPL v2 or later
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'af_enqueue_assets' );
function af_enqueue_assets() {
    // Load scripts in footer (true = footer)
    wp_enqueue_script( 'af-bxslider-js', plugin_dir_url(__FILE__) . 'js/bxslider.js', ['jquery'], '4.2.1', true );
    wp_enqueue_script( 'af-hero-js',     plugin_dir_url(__FILE__) . 'js/anchored-hero.js', ['jquery','af-bxslider-js'], '4.0.0', true );
    // Defer both scripts so they don't block page render
    add_filter('script_loader_tag', 'af_defer_scripts', 10, 2);
}
function af_defer_scripts($tag, $handle){
    $defer = ['af-bxslider-js','af-hero-js'];
    if(in_array($handle, $defer)){
        return str_replace(' src=', ' defer="defer" src=', $tag);
    }
    return $tag;
}

add_action( 'wp_head', 'af_output_styles' );
function af_output_styles() { ?>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
<style id="af-styles">
:root{
  --af-cream:#FAF8F4;
  --af-cream2:#F0EBE1;
  --af-ink:#1A1714;
  --af-stone:#7C746C;
  --af-gold:#B8975A;
  --af-gold-light:#E2CFA0;
  --af-gold-pale:#F5EDD8;
  --af-navy:#1B3356;
  --af-navy2:#152844;
  --af-border:#E2D9CC;
}

/* ── PROGRESS BAR ── */
#af-progress{position:fixed;top:0;left:0;height:3px;width:0;background:var(--af-gold);z-index:9999;transition:width .1s linear;pointer-events:none}

/* ── SCROLL REVEAL ── */
.af-reveal{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.16,1,.3,1),transform .9s cubic-bezier(.16,1,.3,1)}
.af-reveal.af-visible{opacity:1;transform:none}
.af-reveal-left{opacity:0;transform:translateX(-40px);transition:opacity .9s cubic-bezier(.16,1,.3,1),transform .9s cubic-bezier(.16,1,.3,1)}
.af-reveal-left.af-visible{opacity:1;transform:none}
.af-reveal-right{opacity:0;transform:translateX(40px);transition:opacity .9s cubic-bezier(.16,1,.3,1),transform .9s cubic-bezier(.16,1,.3,1)}
.af-reveal-right.af-visible{opacity:1;transform:none}
.af-d1{transition-delay:.1s}.af-d2{transition-delay:.22s}.af-d3{transition-delay:.36s}

/* ── HERO ── */
.af-hero-wrap{position:relative;left:50%;right:50%;margin-left:-50vw!important;margin-right:-50vw!important;width:100vw!important;max-width:100vw!important}
.af-hero-wrap .bx-wrapper{margin:0!important;padding:0!important;border:none!important;box-shadow:none!important;background:transparent!important}
.af-hero-wrap .bx-wrapper .bx-viewport{height:100vh!important;min-height:580px}
.af-hero-wrap .bxslider{margin:0;padding:0;list-style:none}
.af-hero-wrap .bxslider li{position:relative;height:100vh;min-height:580px;overflow:hidden}
.af-slide-bg{position:absolute;inset:0;background-size:cover;background-position:center;animation:af-kb 14s ease-in-out infinite alternate}
@keyframes af-kb{0%{transform:scale(1)}100%{transform:scale(1.08) translate(-1%,-1%)}}
.af-slide-overlay{position:absolute;inset:0;background:linear-gradient(115deg,rgba(20,16,14,.78) 0%,rgba(20,16,14,.42) 50%,rgba(20,16,14,.12) 100%)}
.af-slide-content{position:absolute;bottom:14%;left:9%;max-width:620px;z-index:10}
.af-slide-eyebrow{font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.22em;text-transform:uppercase;color:var(--af-gold-light);margin-bottom:18px;font-weight:500;display:flex;align-items:center;gap:12px}
.af-slide-eyebrow::before{content:'';display:block;width:32px;height:1px;background:var(--af-gold);flex-shrink:0}
.af-slide-title{font-family:'Cormorant Garamond',serif;font-size:clamp(46px,6.5vw,84px);font-weight:300;line-height:1.03;color:#fff;margin-bottom:22px}
.af-slide-title em{font-style:italic;color:var(--af-gold-light)}
.af-slide-desc{font-family:'Jost',sans-serif;font-size:15px;color:rgba(255,255,255,.72);line-height:1.78;margin-bottom:36px;font-weight:300;max-width:440px}
.af-slide-btns{display:flex;gap:14px;flex-wrap:wrap}
.af-btn-gold{display:inline-flex;align-items:center;gap:10px;background:var(--af-gold);color:#fff;font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.14em;text-transform:uppercase;padding:15px 34px;text-decoration:none;font-weight:500;border:1px solid var(--af-gold);transition:all .3s}
.af-btn-gold:hover{background:transparent;color:var(--af-gold-light);text-decoration:none}
.af-btn-outline{display:inline-flex;align-items:center;gap:10px;border:1px solid rgba(255,255,255,.35);color:rgba(255,255,255,.82);font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.14em;text-transform:uppercase;padding:15px 28px;text-decoration:none;font-weight:400;transition:all .3s}
.af-btn-outline:hover{border-color:rgba(255,255,255,.85);color:#fff;text-decoration:none}
.af-hero-wrap .bx-wrapper .bx-pager{position:absolute;bottom:44px;left:9%;text-align:left;padding:0;pointer-events:all;font-size:0;line-height:0}
.af-hero-wrap .bx-wrapper .bx-pager.bx-default-pager a{background:rgba(255,255,255,.28);width:22px;height:3px;border-radius:2px;margin:0 5px 0 0;display:inline-block;text-indent:-9999px;transition:all .35s}
.af-hero-wrap .bx-wrapper .bx-pager.bx-default-pager a.active,.af-hero-wrap .bx-wrapper .bx-pager.bx-default-pager a:hover{background:var(--af-gold);width:48px}
.af-hero-wrap .bx-wrapper .bx-controls-direction{position:absolute;bottom:32px;right:9%;pointer-events:all}
.af-hero-wrap .bx-wrapper .bx-controls-direction a{position:static;width:48px;height:48px;display:inline-flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.28);color:rgba(255,255,255,.85);text-indent:0;font-family:'Jost',sans-serif;font-size:20px;font-weight:300;margin-left:10px;text-decoration:none;background:transparent!important;transition:all .3s;float:none}
.af-hero-wrap .bx-wrapper .bx-controls-direction a:hover{background:rgba(255,255,255,.12)!important;border-color:rgba(255,255,255,.7)}
.af-hero-wrap .bx-wrapper .bx-prev::before{content:'←'}
.af-hero-wrap .bx-wrapper .bx-next::before{content:'→'}
.af-hero-wrap .bx-wrapper .bx-prev,.af-hero-wrap .bx-wrapper .bx-next{background:none!important}
.af-slide-counter{position:absolute;top:50%;right:48px;transform:translateY(-50%);z-index:50;display:flex;flex-direction:column;align-items:center;gap:12px;color:rgba(255,255,255,.4);font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.14em;writing-mode:vertical-lr;pointer-events:none}
.af-slide-counter .af-sc-line{width:1px;height:48px;background:rgba(255,255,255,.15);display:block}

/* ── SCRIPTURE ── */
.af-scripture{background:var(--af-navy);padding:48px 56px;text-align:center;position:relative;overflow:hidden;margin:0;width:100%}
.af-scripture::before{content:'';position:absolute;left:-80px;top:50%;transform:translateY(-50%);width:160px;height:160px;border-radius:50%;background:rgba(184,151,90,.07)}
.af-scripture blockquote{font-family:'Cormorant Garamond',serif;font-size:clamp(18px,2.5vw,28px);font-weight:300;font-style:italic;color:rgba(255,255,255,.9);line-height:1.55;margin:0;position:relative;z-index:1}
.af-scripture cite{display:block;font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.18em;text-transform:uppercase;color:var(--af-gold);margin-top:12px;font-style:normal}

/* ── MARQUEE ── */
.af-marquee-wrap{background:var(--af-gold-pale);padding:20px 0;overflow:hidden;border-top:1px solid #E2CFA0;border-bottom:1px solid #E2CFA0;margin:0;width:100%}
.af-marquee-track{display:flex;gap:64px;white-space:nowrap;animation:af-marquee 30s linear infinite;width:max-content}
.af-marquee-wrap:hover .af-marquee-track{animation-play-state:paused}
@keyframes af-marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.af-marquee-item{font-family:'Cormorant Garamond',serif;font-size:18px;font-style:italic;font-weight:300;color:var(--af-stone);flex-shrink:0;display:inline-flex;align-items:center;gap:20px}
.af-marquee-item::after{content:'✦';font-size:10px;color:var(--af-gold);font-style:normal}

/* ── SHARED SECTION ── */
.af-eyebrow{font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:var(--af-gold);font-weight:500;margin-bottom:14px;display:flex;align-items:center;gap:12px}
.af-eyebrow::before{content:'';display:block;width:24px;height:1px;background:var(--af-gold);flex-shrink:0}
.af-section-title{font-family:'Cormorant Garamond',serif;font-size:clamp(30px,4vw,52px);font-weight:300;line-height:1.1;margin:0 0 14px}
.af-section-sub{font-family:'Jost',sans-serif;font-size:15px;line-height:1.7;font-weight:300;margin:0}

/* ── PATHWAYS ── */
.af-pathways{padding:100px 0;background:var(--af-cream2);margin:0;width:100%}
.af-pathways-header{padding:0 56px;margin-bottom:56px}
.af-pathways-header .af-section-title{color:var(--af-ink)}
.af-pathways-header .af-section-sub{color:var(--af-stone)}
.af-pathways-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;background:var(--af-border)}
.af-pathway-card{background:var(--af-cream);overflow:hidden;cursor:pointer;transition:background .3s}
.af-card-img-wrap{display:block;position:relative;height:300px;overflow:hidden;text-decoration:none}
.af-card-img{width:100%;height:100%;background-size:cover;background-position:center;transition:transform .8s cubic-bezier(.25,.46,.45,.94)}
.af-pathway-card:hover .af-card-img{transform:scale(1.07)}
.af-card-img-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(26,23,20,.55) 0%,transparent 60%);opacity:0;transition:opacity .4s}
.af-pathway-card:hover .af-card-img-overlay{opacity:1}
.af-card-btn{position:absolute;bottom:20px;left:20px;background:var(--af-navy);color:#fff;font-family:'Jost',sans-serif;font-size:12px;font-weight:500;letter-spacing:.08em;padding:10px 22px;transition:background .3s}
.af-pathway-card:hover .af-card-btn{background:var(--af-gold)}
.af-card-body{padding:28px 28px 36px;border-top:3px solid transparent;transition:border-color .3s;background:var(--af-cream)}
.af-pathway-card:hover .af-card-body{border-color:var(--af-gold)}
.af-card-title{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:400;line-height:1.25;margin:0 0 10px;color:var(--af-ink)}
.af-card-desc{font-family:'Jost',sans-serif;font-size:13px;color:var(--af-stone);line-height:1.65;font-weight:300;margin:0}

/* ── CENTERED CALLOUT ── */
.af-centered{background:var(--af-ink);padding:120px 56px;text-align:center;position:relative;overflow:hidden;margin:0;width:100%}
.af-centered::before{content:'';position:absolute;inset:0;opacity:.04;background-image:repeating-linear-gradient(45deg,var(--af-gold) 0,var(--af-gold) 1px,transparent 0,transparent 50%);background-size:28px 28px}
.af-centered-eyebrow{font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:var(--af-gold);font-weight:500;margin:0 0 20px;display:flex;align-items:center;justify-content:center;gap:12px;position:relative;z-index:1}
.af-centered-eyebrow::before{content:'';display:block;width:24px;height:1px;background:var(--af-gold)}
.af-centered-title{font-family:'Cormorant Garamond',serif;font-size:clamp(36px,5vw,68px);font-weight:300;color:#fff;margin:0 auto 20px;line-height:1.05;max-width:700px;position:relative;z-index:1}
.af-centered-title em{font-style:italic;color:var(--af-gold-light)}
.af-centered-desc{font-family:'Jost',sans-serif;font-size:16px;color:rgba(255,255,255,.6);line-height:1.75;font-weight:300;max-width:560px;margin:0 auto;position:relative;z-index:1}

/* ── VIDEOS ── */
.af-videos{padding:100px 56px;background:var(--af-navy2);margin:0;width:100%}
.af-videos .af-eyebrow::before{background:var(--af-gold)}
.af-videos .af-section-title{color:#fff}
.af-videos .af-section-sub{color:rgba(255,255,255,.55)}
.af-videos-grid{display:grid;grid-template-columns:1fr 1fr;gap:36px;margin-top:52px}
.af-video-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);overflow:hidden;transition:border-color .3s,transform .4s cubic-bezier(.25,.46,.45,.94),background .3s}
.af-video-card:hover{border-color:var(--af-gold);transform:translateY(-6px);background:rgba(255,255,255,.07)}
.af-video-thumb{position:relative;padding-bottom:56.25%;background:#000}
.af-video-thumb iframe{position:absolute;inset:0;width:100%;height:100%;border:none}
.af-video-meta{padding:22px 26px 28px}
.af-video-channel{font-family:'Jost',sans-serif;font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--af-gold);font-weight:600;margin:0 0 8px}
.af-video-title{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:400;line-height:1.3;color:rgba(255,255,255,.9);margin:0}

/* ── FULL WIDTH ELEMENTOR FIX ── */
.elementor-widget-shortcode,.elementor-widget-shortcode .elementor-widget-container{padding:0!important;margin:0!important}
.e-con:has(.af-pathways),.e-con:has(.af-videos),.e-con:has(.af-centered),.e-con:has(.af-scripture),.e-con:has(.af-marquee-wrap){padding:0!important;max-width:100%!important}
.elementor-section:has(.af-pathways),.elementor-section:has(.af-videos),.elementor-section:has(.af-centered){padding:0!important}
.elementor-section:has(.af-pathways) .elementor-container,.elementor-section:has(.af-videos) .elementor-container,.elementor-section:has(.af-centered) .elementor-container{max-width:100%!important;padding:0!important}

/* ── RESPONSIVE ── */
@media(max-width:768px){
  .af-pathways-grid,.af-videos-grid{grid-template-columns:1fr}
  .af-pathways-header,.af-videos,.af-centered{padding-left:24px;padding-right:24px}
  .af-slide-counter{display:none}
  .af-scripture{padding:36px 24px}
}
</style>
<?php }

/* ── [af_hero_slider] ── */
add_shortcode('af_hero_slider','af_hero_slider_shortcode');
function af_hero_slider_shortcode(){
    $slides=[
        ['image'=>'/wp-content/uploads/2026/01/Homepage.jpg','eyebrow'=>'Welcome','title'=>'Anchoring Faith in <em>Jesus Christ</em>','desc'=>'Through testimony, evidence, and lived experience — strengthening hearts and minds in Him.','btn_text'=>'Explore Articles','btn_url'=>'/posts/','btn2_text'=>'Learn More','btn2_url'=>'/about-us-2/'],
        ['image'=>'/wp-content/uploads/2026/01/General_Conference.jpg','eyebrow'=>'General Conference','title'=>'Words That <em>Nourish the Soul</em>','desc'=>'Inspired messages from Church leaders — timeless teachings for our day.','btn_text'=>'Watch Now','btn_url'=>'/videos/','btn2_text'=>'','btn2_url'=>''],
        ['image'=>'/wp-content/uploads/2026/01/jesus_holding_children_phyllis_luch.webp','eyebrow'=>'For Families','title'=>'Faith for the <em>Next Generation</em>','desc'=>'Resources and stories to nurture lasting faith in children and youth.','btn_text'=>'For Kids','btn_url'=>'/for-kids/','btn2_text'=>'Resources','btn2_url'=>'/resources/'],
    ];
    ob_start();?>
    <div class="af-hero-wrap">
      <ul class="bxslider">
        <?php foreach($slides as $s):?>
        <li>
          <div class="af-slide-bg" style="background-image:url('<?php echo esc_url($s['image']);?>')"></div>
          <div class="af-slide-overlay"></div>
          <div class="af-slide-content">
            <?php if($s['eyebrow']):?><p class="af-slide-eyebrow"><?php echo esc_html($s['eyebrow']);?></p><?php endif;?>
            <h2 class="af-slide-title"><?php echo wp_kses($s['title'],['em'=>[],'strong'=>[],'br'=>[]]);?></h2>
            <p class="af-slide-desc"><?php echo esc_html($s['desc']);?></p>
            <div class="af-slide-btns">
              <a href="<?php echo esc_url($s['btn_url']);?>" class="af-btn-gold"><?php echo esc_html($s['btn_text']);?> &rarr;</a>
              <?php if($s['btn2_text']):?><a href="<?php echo esc_url($s['btn2_url']);?>" class="af-btn-outline"><?php echo esc_html($s['btn2_text']);?></a><?php endif;?>
            </div>
          </div>
        </li>
        <?php endforeach;?>
      </ul>
      <div class="af-slide-counter">
        <span class="af-cur">01</span><span class="af-sc-line"></span><span class="af-tot"><?php echo str_pad(count($slides),2,'0',STR_PAD_LEFT);?></span>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_scripture] ── */
add_shortcode('af_scripture','af_scripture_shortcode');
function af_scripture_shortcode(){
    ob_start();?>
    <div class="af-scripture af-reveal">
      <blockquote>"We have this hope as an anchor for the soul, firm and secure."<cite>&mdash; Hebrews 6:19</cite></blockquote>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_marquee] ── */
add_shortcode('af_marquee','af_marquee_shortcode');
function af_marquee_shortcode(){
    $items=['Anchored in Christ','Faith Through Evidence','Living Testimonies','Book of Mormon Witnesses','For Kids & Families','Podcasts Coming Soon'];
    $all=array_merge($items,$items);
    ob_start();?>

    <!-- ANNOUNCEMENT BAR -->
    <div class="af-announcement-bar">
      <div class="af-announcement-inner">
        <span class="af-announcement-badge">New!</span>
        <span class="af-announcement-icon">🎙️</span>
        <span class="af-announcement-text">
          An Anchored Faith Podcast is live &nbsp;|&nbsp; Faith conversations, testimonies &amp; gospel insights
        </span>
        <a href="/podcasts/" class="af-announcement-link">Listen Now →</a>
      </div>
    </div>

    <!-- MARQUEE TICKER -->
    <div class="af-marquee-wrap">
      <div class="af-marquee-track">
        <?php foreach($all as $item):?><span class="af-marquee-item"><?php echo esc_html($item);?></span><?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_pathways] ── */
add_shortcode('af_pathways','af_pathways_shortcode');
function af_pathways_shortcode(){
    $pathways=[
        ['image'=>'/wp-content/uploads/2025/12/chris-liu-EUCMJmaGWU8-unsplash-1024x768.jpg','title'=>'Faith Promoting Experiences','desc'=>'Personal testimonies miracles and lived experiences of faith.','url'=>'#'],
        ['image'=>'/wp-content/uploads/2025/12/degleex-ganzorig-wQImoykAwGs-unsplash-2-683x1024.jpg','title'=>'Evidences of the Restoration','desc'=>'Exploring the Book of Mormon Joseph Smith and the Restoration.','url'=>'#'],
        ['image'=>'/wp-content/uploads/2025/12/cristine-enero-kWVbLBxvlVw-unsplash-1024x684.jpg','title'=>'Influencer Spotlights','desc'=>'Faith centered videos and insights from LDS creators.','url'=>'#'],
    ];
    ob_start();?>
    <div class="af-pathways">
      <div class="af-pathways-header af-reveal">
        <p class="af-eyebrow">Explore</p>
        <h2 class="af-section-title">Explore Faith Building Pathways</h2>
        <p class="af-section-sub">Choose a place to begin your journey of faith exploration and understanding.</p>
      </div>
      <div class="af-pathways-grid">
        <?php foreach($pathways as $i=>$p):?>
        <div class="af-pathway-card af-reveal af-d<?php echo $i+1;?>">
          <a href="<?php echo esc_url($p['url']);?>" class="af-card-img-wrap">
            <div class="af-card-img" style="background-image:url('<?php echo esc_url($p['image']);?>')"></div>
            <div class="af-card-img-overlay"></div>
            <span class="af-card-btn">Explore</span>
          </a>
          <div class="af-card-body">
            <h3 class="af-card-title"><?php echo esc_html($p['title']);?></h3>
            <p class="af-card-desc"><?php echo esc_html($p['desc']);?></p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_centered] ── */
add_shortcode('af_centered','af_centered_shortcode');
function af_centered_shortcode(){
    ob_start();?>
    <div class="af-centered af-reveal">
      <p class="af-centered-eyebrow">Our Foundation</p>
      <h2 class="af-centered-title">Centered on <em>Jesus Christ</em></h2>
      <p class="af-centered-desc">Jesus Christ is the foundation of our faith. Through testimony, evidence, and lived experience we seek to strengthen hearts and minds in Him.</p>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_videos] ── */
add_shortcode('af_videos','af_videos_shortcode');
function af_videos_shortcode(){
    /*
     * VIDEO 1: Your @ananchoredfaith channel video
     * Replace YOUR_VIDEO_ID below with the YouTube video ID from your channel
     * e.g. if URL is https://www.youtube.com/watch?v=abc123 then use abc123
     *
     * VIDEO 2: President Dallin H. Oaks — "Coming Closer to Jesus Christ"
     * BYU Devotional, February 10, 2026 — his first address as the 18th Prophet
     */
    $videos=[
        [
            'embed'   => 'https://www.youtube.com/embed/qZS7UAe98r4',
            'channel' => 'An Anchored Faith Podcast',
            'title'   => 'Episódio 2: O Meu Caminho à Conversão | Keymen Sweetness',
            'badge'   => 'Podcast',
            'link'    => 'https://www.youtube.com/@ananchoredfaith',
        ],
        [
            'embed'   => 'https://www.youtube.com/embed/KYYVpLLE37g',
            'channel' => 'An Anchored Faith Podcast',
            'title'   => 'Como a Fé Transformou Angelo Nhantumbo',
            'badge'   => 'Testimunho',
            'link'    => 'https://www.youtube.com/@ananchoredfaith',
        ],
        [
            'embed'   => 'https://www.youtube.com/embed/YUipuJF2daw',
            'channel' => 'An Anchored Faith',
            'title'   => 'Como Enfrentar os Desafios do Mundo Atual | Conferência Geral Outubro 2015',
            'badge'   => 'Conferência Geral',
            'link'    => 'https://www.youtube.com/@ananchoredfaith',
        ],
    ];
    ob_start();?>
    <div class="af-videos">
      <div class="af-reveal">
        <p class="af-eyebrow">Featured Content</p>
        <h2 class="af-section-title">Featured Videos</h2>
        <p class="af-section-sub">From our channel — faith centred conversations, testimonies and gospel insights.</p>
      </div>
      <div class="af-videos-grid" style="grid-template-columns:repeat(3,1fr)">
        <?php foreach($videos as $i=>$v):?>
        <div class="af-video-card af-reveal af-d<?php echo $i+1;?>">
          <?php if(!empty($v['badge'])):?>
          <div class="af-video-badge"><?php echo esc_html($v['badge']);?></div>
          <?php endif;?>
          <div class="af-video-thumb">
            <?php if($v['embed'] === 'https://www.youtube.com/embed/YOUR_VIDEO_ID'):?>
            <div class="af-video-placeholder">
              <div class="af-video-placeholder-inner">
                <?php echo af_icon('microphone',48,'var(--af-gold)');?>
                <p>Paste your YouTube video URL in the plugin to display your featured video here.</p>
                <a href="<?php echo esc_url($v['link']);?>" target="_blank" class="af-btn-gold" style="font-size:11px;padding:10px 20px;margin-top:12px;display:inline-flex">Visit Our Channel →</a>
              </div>
            </div>
            <?php else:?>
            <iframe src="<?php echo esc_url($v['embed']);?>" allowfullscreen loading="lazy"></iframe>
            <?php endif;?>
          </div>
          <div class="af-video-meta">
            <p class="af-video-channel"><?php echo esc_html($v['channel']);?></p>
            <h4 class="af-video-title"><?php echo esc_html($v['title']);?></h4>
            <?php if(!empty($v['link']) && $v['embed'] !== 'https://www.youtube.com/embed/YOUR_VIDEO_ID'):?>
            <a href="<?php echo esc_url($v['link']);?>" target="_blank" class="af-video-read-more">Read full talk →</a>
            <?php endif;?>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <style>
    .af-video-badge{
      position:absolute;top:16px;left:16px;z-index:5;
      background:var(--af-gold);color:#fff;
      font-family:'Jost',sans-serif;font-size:10px;
      font-weight:600;letter-spacing:.14em;text-transform:uppercase;
      padding:5px 12px;
    }
    .af-video-card{position:relative}
    .af-video-placeholder{
      position:absolute;inset:0;
      display:flex;align-items:center;justify-content:center;
      background:rgba(27,51,86,.95);
    }
    .af-video-placeholder-inner{
      text-align:center;padding:32px;
    }
    .af-video-placeholder-inner p{
      font-family:'Jost',sans-serif;font-size:13px;
      color:rgba(255,255,255,.7);line-height:1.6;
      margin:16px 0 0;max-width:240px;font-weight:300;
    }
    .af-video-read-more{
      font-family:'Jost',sans-serif;font-size:11px;
      letter-spacing:.12em;text-transform:uppercase;
      color:var(--af-gold);font-weight:500;
      text-decoration:none;display:inline-flex;
      align-items:center;gap:6px;margin-top:10px;
      transition:gap .2s;
    }
    .af-video-read-more:hover{gap:10px;text-decoration:none;color:var(--af-gold-light)}
    </style>
    <?php return ob_get_clean();
}

/* ── FULL WIDTH BREAKOUT for all af sections ── */
add_action('wp_head','af_fullwidth_css', 99);
function af_fullwidth_css(){ ?>
<style id="af-fullwidth">
/* Break every af section out of Elementor's container */
.af-scripture,
.af-marquee-wrap,
.af-pathways,
.af-centered,
.af-videos {
  position: relative;
  left: 50%;
  right: 50%;
  margin-left:  -50vw !important;
  margin-right: -50vw !important;
  width:     100vw !important;
  max-width: 100vw !important;
  box-sizing: border-box;
}
/* Kill all Elementor padding around our shortcodes */
.elementor-widget-shortcode .elementor-widget-container,
.elementor-widget-shortcode {
  padding: 0 !important;
  margin:  0 !important;
}
</style>
<?php }

/* ── FOOTER & GAP FIX ── */
add_action('wp_head','af_footer_css', 100);
function af_footer_css(){ ?>
<style id="af-footer">
/* Kill white gap between last section and footer */
.site-footer,
footer.site-footer,
#colophon,
.kadence-footer,
footer {
  background: #1A1714 !important;
  color: rgba(255,255,255,0.45) !important;
  border-top: 1px solid rgba(255,255,255,0.07) !important;
  padding: 40px 56px !important;
}
footer a,
.site-footer a,
#colophon a {
  color: rgba(255,255,255,0.45) !important;
  transition: color 0.2s !important;
}
footer a:hover,
.site-footer a:hover,
#colophon a:hover {
  color: #B8975A !important;
}
/* Social icons */
footer .social-link svg,
footer svg {
  fill: rgba(255,255,255,0.45) !important;
  transition: fill 0.2s !important;
}
footer .social-link:hover svg,
footer a:hover svg {
  fill: #B8975A !important;
}
/* Kill any white space above footer */
.site-content,
#content,
.content-area,
main#main {
  margin-bottom: 0 !important;
  padding-bottom: 0 !important;
}
/* Remove white gap caused by Elementor section margin */
.elementor-section:last-child,
.e-con:last-child {
  margin-bottom: 0 !important;
  padding-bottom: 0 !important;
}
</style>
<?php }

/* ── [af_resources] — Podcasts teaser section ── */
add_shortcode('af_resources','af_resources_shortcode');
function af_resources_shortcode(){
    ob_start();?>
    <div class="af-resources af-reveal">
      <div class="af-resources-inner">
        <div class="af-resources-left af-reveal-left">
          <p class="af-eyebrow" style="color:var(--af-gold)">Coming Soon</p>
          <h2 class="af-section-title" style="color:#fff">Resources for<br>Deeper Study</h2>
          <p class="af-resources-desc">Books, podcasts, and talks to support continued learning and spiritual growth. We are building a full library of faith-centred audio content.</p>
          <a href="/podcasts/" class="af-btn-gold" style="margin-top:32px;display:inline-flex">Explore Podcasts &rarr;</a>
        </div>
        <div class="af-resources-right af-reveal-right af-d2">
          <div class="af-podcast-preview">
            <div class="af-pod-icon">&#127911;</div>
            <div class="af-pod-text">
              <p class="af-pod-label">Featured Podcast</p>
              <h4 class="af-pod-title">An Anchored Faith Podcast</h4>
              <p class="af-pod-sub">Faith building conversations coming soon</p>
            </div>
          </div>
          <div class="af-podcast-preview af-d2">
            <div class="af-pod-icon">&#127908;</div>
            <div class="af-pod-text">
              <p class="af-pod-label">Talks & Devotionals</p>
              <h4 class="af-pod-title">General Conference Highlights</h4>
              <p class="af-pod-sub">Audio from Church leaders worldwide</p>
            </div>
          </div>
          <div class="af-podcast-preview af-d3">
            <div class="af-pod-icon">&#128214;</div>
            <div class="af-pod-text">
              <p class="af-pod-label">Books & Study Guides</p>
              <h4 class="af-pod-title">Recommended Reading</h4>
              <p class="af-pod-sub">Curated resources for deeper faith</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── RESOURCES CSS ── */
add_action('wp_head','af_resources_css', 101);
function af_resources_css(){ ?>
<style id="af-resources-css">
.af-resources{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy2);
  padding:100px 56px;
  box-sizing:border-box;
}
.af-resources-inner{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:80px;
  max-width:1200px;
  margin:0 auto;
  align-items:center;
}
.af-resources-desc{
  font-family:'Jost',sans-serif;
  font-size:15px;color:rgba(255,255,255,.55);
  line-height:1.75;font-weight:300;
  margin-top:16px;max-width:420px;
}
.af-podcast-preview{
  display:flex;gap:20px;align-items:center;
  padding:24px 28px;
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.08);
  margin-bottom:16px;
  transition:border-color .3s,background .3s,transform .3s;
  cursor:pointer;
}
.af-podcast-preview:hover{
  border-color:var(--af-gold);
  background:rgba(255,255,255,.07);
  transform:translateX(6px);
}
.af-pod-icon{
  width:52px;height:52px;
  background:rgba(184,151,90,.15);
  border:1px solid rgba(184,151,90,.3);
  display:flex;align-items:center;justify-content:center;
  font-size:22px;flex-shrink:0;
  transition:background .3s;
}
.af-podcast-preview:hover .af-pod-icon{background:rgba(184,151,90,.25)}
.af-pod-label{
  font-family:'Jost',sans-serif;
  font-size:10px;letter-spacing:.18em;text-transform:uppercase;
  color:var(--af-gold);font-weight:600;margin:0 0 4px;
}
.af-pod-title{
  font-family:'Cormorant Garamond',serif;
  font-size:18px;font-weight:400;color:rgba(255,255,255,.9);
  margin:0 0 4px;line-height:1.3;
}
.af-pod-sub{
  font-family:'Jost',sans-serif;
  font-size:12px;color:rgba(255,255,255,.4);
  font-weight:300;margin:0;
}
@media(max-width:768px){
  .af-resources-inner{grid-template-columns:1fr;gap:48px}
  .af-resources{padding:64px 24px}
}
</style>
<?php }

/* ============================================================
   [af_kids_hero] — For Kids page hero
   ============================================================ */
add_shortcode('af_kids_hero','af_kids_hero_shortcode');
function af_kids_hero_shortcode(){
    ob_start();?>
    <div class="af-kids-hero">
      <div class="af-kids-hero-inner">
        <div class="af-kids-hero-content af-reveal">
          <p class="af-eyebrow" style="color:var(--af-gold)">For Kids</p>
          <h1 class="af-kids-hero-title">Building Faith in<br><em>Little Hearts</em></h1>
          <p class="af-kids-hero-desc">Helping children build faith in Jesus Christ can be joyful, simple, and deeply meaningful. This page gathers trusted, Christ-centred resources designed to help children learn the gospel in age-appropriate ways and develop a love for Jesus Christ.</p>
        </div>
        <div class="af-kids-hero-image af-reveal-right af-d2">
          <img src="/wp-content/uploads/2026/01/jesus_holding_children_phyllis_luch.webp" alt="Jesus with children" />
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ============================================================
   [af_kids_resources] — Core Kids Faith Resources
   ============================================================ */
add_shortcode('af_kids_resources','af_kids_resources_shortcode');
function af_kids_resources_shortcode(){
    $resources = [
        ['icon'=>af_icon('scriptures',40,'currentColor'),'title'=>'The Friend Magazine','desc'=>'A monthly magazine created for children with faith promoting stories, activities and lessons that teach gospel principles in simple language.','url'=>'#','color'=>'var(--af-navy)'],
        ['icon'=>af_icon('book_of_mormon',40,'currentColor'),'title'=>'Scripture Stories for Children','desc'=>'Illustrated scripture stories from the Bible and Book of Mormon that help children learn through visual storytelling.','url'=>'#','color'=>'#2D5A3D'],
        ['icon'=>af_icon('tv_screen',40,'currentColor'),'title'=>'Videos and Music for Kids','desc'=>'Visual and audio resources help children connect gospel principles with real stories and experiences.','url'=>'#','color'=>'#5A2D82'],
        ['icon'=>af_icon('play',40,'currentColor'),'title'=>'Animated Scripture Videos','desc'=>'Short animated videos that bring scripture stories to life and reinforce lessons about faith, obedience and Jesus Christ.','url'=>'#','color'=>'#8B3A1A'],
        ['icon'=>af_icon('journal',40,'currentColor'),'title'=>'Living Scriptures','desc'=>'Professionally animated scripture stories used by many families as a supplemental faith building resource.','url'=>'#','color'=>'#1A5A5A'],
        ['icon'=>af_icon('music_notes',40,'currentColor'),'title'=>'Primary Songs and Music','desc'=>'Faith based music that helps children learn gospel truths through repetition and melody.','url'=>'#','color'=>'#5A1A3A'],
    ];
    ob_start();?>
    <div class="af-kids-resources">
      <div class="af-kids-resources-header af-reveal">
        <p class="af-eyebrow">Resources</p>
        <h2 class="af-section-title" style="color:#fff">Core Kids Faith Resources</h2>
        <p class="af-kids-section-sub">These foundational resources are trusted by many Latter-day Saint families and are designed specifically for children.</p>
      </div>
      <div class="af-kids-grid">
        <?php foreach($resources as $i=>$r):?>
        <div class="af-kids-card af-reveal af-d<?php echo min($i+1,3);?>" style="--card-accent:<?php echo $r['color'];?>">
          <div class="af-kids-card-icon"><?php echo $r['icon'];?></div>
          <h3 class="af-kids-card-title"><?php echo esc_html($r['title']);?></h3>
          <p class="af-kids-card-desc"><?php echo esc_html($r['desc']);?></p>
          <a href="<?php echo esc_url($r['url']);?>" class="af-kids-card-link">Explore &rarr;</a>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ============================================================
   [af_kids_activities] — Hands On Activities
   ============================================================ */
add_shortcode('af_kids_activities','af_kids_activities_shortcode');
function af_kids_activities_shortcode(){
    $activities = [
        ['icon'=>af_icon('come_follow_me',40,'currentColor'),'title'=>'Come Follow Me for Primary','desc'=>'Weekly scripture study resources aligned with the Church curriculum.'],
        ['icon'=>af_icon('paint',40,'currentColor'),'title'=>'Faith Colouring & Activity Pages','desc'=>'Printable pages that reinforce gospel stories and principles through creativity.'],
        ['icon'=>af_icon('journal',40,'currentColor'),'title'=>'Scripture Journals for Kids','desc'=>'Guided journals to help children record their faith experiences and testimonies.'],
    ];
    ob_start();?>
    <div class="af-kids-activities">
      <div class="af-kids-activities-inner">
        <div class="af-kids-activities-left af-reveal-left">
          <p class="af-eyebrow">Hands On</p>
          <h2 class="af-section-title" style="color:var(--af-ink)">Faith Building<br>Activities</h2>
          <p class="af-section-sub" style="color:var(--af-stone)">Children often learn best by doing. These resources help reinforce gospel principles through creativity and participation.</p>
        </div>
        <div class="af-kids-activities-right">
          <?php foreach($activities as $i=>$a):?>
          <div class="af-activity-item af-reveal af-d<?php echo $i+1;?>">
            <div class="af-activity-icon"><?php echo $a['icon'];?></div>
            <div>
              <h4 class="af-activity-title"><?php echo esc_html($a['title']);?></h4>
              <p class="af-activity-desc"><?php echo esc_html($a['desc']);?></p>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ============================================================
   [af_kids_why] — Why Kids Faith Resources Matter + Parents tip
   ============================================================ */
add_shortcode('af_kids_why','af_kids_why_shortcode');
function af_kids_why_shortcode(){
    ob_start();?>
    <div class="af-kids-why">
      <div class="af-kids-why-inner">
        <div class="af-kids-why-text af-reveal">
          <p class="af-eyebrow">Why It Matters</p>
          <h2 class="af-section-title" style="color:#fff">Why Kids Faith<br>Resources Matter</h2>
          <p class="af-kids-why-desc">Faith centred resources help children build a relationship with Jesus Christ, recognise the Spirit, and understand gospel truths in ways that grow with them throughout their lives.</p>
        </div>
        <div class="af-kids-tip af-reveal-right af-d2">
          <div class="af-tip-badge">Tip for Parents</div>
          <p class="af-tip-text">Faith grows best through consistency, not perfection. Simple daily moments — like bedtime stories, music during routines, or short conversations — can make a lasting spiritual impact.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── FOR KIDS CSS ── */
add_action('wp_head','af_kids_css',102);
function af_kids_css(){ ?>
<style id="af-kids-css">

/* KIDS HERO */
.af-kids-hero{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy);
  padding:100px 56px;box-sizing:border-box;
  overflow:hidden;
}
.af-kids-hero::before{
  content:'';position:absolute;
  right:-100px;top:-100px;
  width:500px;height:500px;
  border-radius:50%;
  background:rgba(184,151,90,.06);
}
.af-kids-hero-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-kids-hero-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(42px,5.5vw,76px);
  font-weight:300;line-height:1.05;
  color:#fff;margin:0 0 24px;
}
.af-kids-hero-title em{font-style:italic;color:var(--af-gold-light)}
.af-kids-hero-desc{
  font-family:'Jost',sans-serif;
  font-size:15px;color:rgba(255,255,255,.65);
  line-height:1.78;font-weight:300;max-width:480px;margin:0;
}
.af-kids-hero-image img{
  width:100%;border-radius:4px;
  box-shadow:0 40px 80px rgba(0,0,0,.4);
}

/* KIDS RESOURCES */
.af-kids-resources{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:100px 56px;box-sizing:border-box;
}
.af-kids-resources-header{margin-bottom:56px}
.af-kids-section-sub{
  font-family:'Jost',sans-serif;
  font-size:15px;color:rgba(255,255,255,.5);
  line-height:1.7;font-weight:300;margin:0;max-width:560px;
}
.af-kids-grid{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:2px;background:rgba(255,255,255,.06);
}
.af-kids-card{
  background:#1C1916;
  padding:40px 32px;
  border-top:3px solid transparent;
  transition:border-color .3s,background .3s,transform .4s;
  cursor:pointer;
}
.af-kids-card:hover{
  border-color:var(--af-gold);
  background:#222018;
  transform:translateY(-4px);
}
.af-kids-card-icon{font-size:36px;margin-bottom:20px;display:block}
.af-kids-card-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:rgba(255,255,255,.9);
  margin:0 0 12px;line-height:1.3;
}
.af-kids-card-desc{
  font-family:'Jost',sans-serif;
  font-size:13px;color:rgba(255,255,255,.45);
  line-height:1.65;font-weight:300;margin:0 0 24px;
}
.af-kids-card-link{
  font-family:'Jost',sans-serif;
  font-size:11px;letter-spacing:.14em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;text-decoration:none;
  transition:gap .2s;display:inline-flex;align-items:center;gap:6px;
}
.af-kids-card-link:hover{gap:12px;text-decoration:none;color:var(--af-gold-light)}

/* KIDS ACTIVITIES */
.af-kids-activities{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-cream2);
  padding:100px 56px;box-sizing:border-box;
}
.af-kids-activities-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-activity-item{
  display:flex;gap:20px;align-items:flex-start;
  padding:28px;
  background:#fff;
  border:1px solid var(--af-border);
  margin-bottom:16px;
  transition:border-color .3s,transform .3s,box-shadow .3s;
}
.af-activity-item:hover{
  border-color:var(--af-gold);
  transform:translateX(6px);
  box-shadow:0 8px 32px rgba(0,0,0,.06);
}
.af-activity-icon{font-size:28px;flex-shrink:0;margin-top:2px}
.af-activity-title{
  font-family:'Cormorant Garamond',serif;
  font-size:20px;font-weight:400;
  color:var(--af-ink);margin:0 0 6px;
}
.af-activity-desc{
  font-family:'Jost',sans-serif;
  font-size:13px;color:var(--af-stone);
  line-height:1.6;font-weight:300;margin:0;
}

/* KIDS WHY */
.af-kids-why{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy2);
  padding:100px 56px;box-sizing:border-box;
}
.af-kids-why-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-kids-why-desc{
  font-family:'Jost',sans-serif;
  font-size:15px;color:rgba(255,255,255,.6);
  line-height:1.78;font-weight:300;margin:16px 0 0;
}
.af-kids-tip{
  background:rgba(184,151,90,.08);
  border:1px solid rgba(184,151,90,.25);
  padding:48px 40px;
}
.af-tip-badge{
  font-family:'Jost',sans-serif;
  font-size:10px;letter-spacing:.2em;text-transform:uppercase;
  color:var(--af-gold);font-weight:600;
  background:rgba(184,151,90,.15);
  display:inline-block;padding:6px 16px;
  margin-bottom:20px;
}
.af-tip-text{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:300;font-style:italic;
  color:rgba(255,255,255,.85);line-height:1.6;margin:0;
}

/* RESPONSIVE */
@media(max-width:768px){
  .af-kids-hero-inner,.af-kids-activities-inner,.af-kids-why-inner{grid-template-columns:1fr;gap:48px}
  .af-kids-grid{grid-template-columns:1fr}
  .af-kids-hero,.af-kids-resources,.af-kids-activities,.af-kids-why{padding-left:24px;padding-right:24px}
  .af-kids-hero-image{display:none}
}
</style>
<?php }

/* ── KIDS PAGE v2 CSS — warm, playful, premium ── */
add_action('wp_head','af_kids_v2_css',103);
function af_kids_v2_css(){ ?>
<style id="af-kids-v2">
:root{
  --kd-sky:#EBF4FF;
  --kd-sun:#FFF3D6;
  --kd-mint:#E8F7F0;
  --kd-rose:#FFF0F0;
  --kd-gold:#D4972A;
  --kd-navy:#1B3356;
  --kd-teal:#0F7B6C;
  --kd-coral:#D95F3B;
  --kd-purple:#6B4BB5;
  --kd-ink:#2C2416;
  --kd-stone:#7A6E62;
}

/* ── KIDS HERO v2 ── */
.af-kids-hero-v2{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:linear-gradient(135deg,#1B3356 0%,#2D5A8E 50%,#1B4A6B 100%);
  padding:90px 56px 80px;box-sizing:border-box;
  overflow:hidden;
}
.af-kids-hero-v2::before{
  content:'';position:absolute;
  top:-120px;right:-120px;
  width:400px;height:400px;border-radius:50%;
  background:rgba(212,151,42,.12);
}
.af-kids-hero-v2::after{
  content:'';position:absolute;
  bottom:-80px;left:-80px;
  width:280px;height:280px;border-radius:50%;
  background:rgba(255,255,255,.04);
}
.af-kids-hero-v2-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:64px;align-items:center;
  max-width:1200px;margin:0 auto;position:relative;z-index:1;
}
.af-kids-tag{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(212,151,42,.2);
  border:1px solid rgba(212,151,42,.4);
  color:#F5C842;
  font-family:'Jost',sans-serif;
  font-size:11px;letter-spacing:.18em;text-transform:uppercase;
  font-weight:600;padding:7px 16px;margin-bottom:20px;
}
.af-kids-hero-v2-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(44px,5.5vw,78px);
  font-weight:300;line-height:1.04;
  color:#fff;margin:0 0 20px;
}
.af-kids-hero-v2-title em{
  font-style:italic;color:#F5C842;
}
.af-kids-hero-v2-desc{
  font-family:'Jost',sans-serif;
  font-size:15px;color:rgba(255,255,255,.7);
  line-height:1.78;font-weight:300;margin:0 0 36px;max-width:460px;
}
.af-kids-hero-v2-btns{display:flex;gap:14px;flex-wrap:wrap}
.af-kids-btn-primary{
  display:inline-flex;align-items:center;gap:8px;
  background:#D4972A;color:#fff;
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  padding:14px 32px;text-decoration:none;font-weight:500;
  border:1px solid #D4972A;transition:all .3s;
}
.af-kids-btn-primary:hover{background:transparent;color:#F5C842;text-decoration:none}
.af-kids-btn-ghost{
  display:inline-flex;align-items:center;gap:8px;
  border:1px solid rgba(255,255,255,.3);
  color:rgba(255,255,255,.8);
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  padding:14px 28px;text-decoration:none;font-weight:400;transition:all .3s;
}
.af-kids-btn-ghost:hover{border-color:#fff;color:#fff;text-decoration:none}
.af-kids-hero-v2-img img{
  width:100%;border-radius:8px;
  box-shadow:0 32px 80px rgba(0,0,0,.35);
}

/* ── SCRIPTURE OF THE WEEK ── */
.af-kids-verse{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--kd-sun);
  padding:72px 56px;box-sizing:border-box;
  border-bottom:3px solid #F5C842;
}
.af-kids-verse-inner{
  max-width:800px;margin:0 auto;text-align:center;
}
.af-kids-verse-label{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.2em;text-transform:uppercase;
  color:var(--kd-gold);font-weight:600;
  margin-bottom:24px;display:block;
}
.af-kids-verse-text{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(28px,4vw,48px);
  font-weight:300;font-style:italic;
  color:var(--kd-ink);line-height:1.4;
  margin:0 0 16px;
}
.af-kids-verse-ref{
  font-family:'Jost',sans-serif;font-size:13px;
  color:var(--kd-stone);font-weight:400;
  letter-spacing:.1em;margin:0;
}

/* ── AGE TABS ── */
.af-kids-ages{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:#fff;padding:96px 56px;box-sizing:border-box;
}
.af-kids-ages-header{text-align:center;margin-bottom:48px}
.af-kids-ages-header h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(30px,4vw,50px);font-weight:300;
  color:var(--kd-ink);margin:0 0 12px;
}
.af-kids-ages-header p{
  font-family:'Jost',sans-serif;font-size:15px;
  color:var(--kd-stone);font-weight:300;margin:0;
}
.af-age-tabs{
  display:flex;justify-content:center;gap:8px;
  flex-wrap:wrap;margin-bottom:48px;
}
.af-age-tab{
  font-family:'Jost',sans-serif;font-size:12px;
  letter-spacing:.1em;text-transform:uppercase;font-weight:500;
  padding:12px 28px;border:2px solid var(--kd-navy);
  color:var(--kd-navy);background:transparent;
  cursor:pointer;transition:all .25s;
}
.af-age-tab:hover,.af-age-tab.active{
  background:var(--kd-navy);color:#fff;
}
.af-age-panel{display:none}
.af-age-panel.active{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.af-age-card{
  padding:32px 28px;
  border:2px solid transparent;
  transition:border-color .3s,transform .3s;
  cursor:pointer;
}
.af-age-card:hover{transform:translateY(-4px)}
.af-age-card.sky{background:var(--kd-sky);}.af-age-card.sky:hover{border-color:#93C5FD}
.af-age-card.sun{background:var(--kd-sun);}.af-age-card.sun:hover{border-color:#F5C842}
.af-age-card.mint{background:var(--kd-mint);}.af-age-card.mint:hover{border-color:#6EE7B7}
.af-age-card.rose{background:var(--kd-rose);}.af-age-card.rose:hover{border-color:#FCA5A5}
.af-age-card-icon{font-size:32px;margin-bottom:14px;display:block}
.af-age-card-title{
  font-family:'Cormorant Garamond',serif;
  font-size:20px;font-weight:400;
  color:var(--kd-ink);margin:0 0 8px;
}
.af-age-card-desc{
  font-family:'Jost',sans-serif;font-size:13px;
  color:var(--kd-stone);line-height:1.6;
  font-weight:300;margin:0;
}

/* ── FEATURED RESOURCE ── */
.af-kids-featured{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--kd-mint);
  padding:96px 56px;box-sizing:border-box;
}
.af-kids-featured-inner{
  display:grid;grid-template-columns:1fr 2fr;
  gap:64px;align-items:center;
  max-width:1100px;margin:0 auto;
}
.af-kids-featured-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--kd-teal);color:#fff;
  font-family:'Jost',sans-serif;font-size:10px;
  letter-spacing:.18em;text-transform:uppercase;
  font-weight:600;padding:7px 16px;margin-bottom:20px;
}
.af-kids-featured-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(32px,4vw,54px);font-weight:300;
  color:var(--kd-ink);margin:0 0 16px;line-height:1.1;
}
.af-kids-featured-desc{
  font-family:'Jost',sans-serif;font-size:15px;
  color:var(--kd-stone);line-height:1.75;
  font-weight:300;margin:0 0 32px;
}
.af-kids-featured-img{
  background:var(--kd-sky);
  height:360px;display:flex;
  align-items:center;justify-content:center;
  font-size:80px;border:3px solid rgba(15,123,108,.15);
}

/* ── RESOURCES v2 ── */
.af-kids-resources-v2{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:#fff;padding:96px 56px;box-sizing:border-box;
}
.af-kids-resources-v2-header{margin-bottom:56px}
.af-kids-resources-v2-header h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(30px,4vw,50px);font-weight:300;
  color:var(--kd-ink);margin:0 0 12px;
}
.af-kids-resources-v2-header p{
  font-family:'Jost',sans-serif;font-size:15px;
  color:var(--kd-stone);font-weight:300;margin:0;
}
.af-kids-resources-v2-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:24px;
}
.af-kres-card{
  padding:36px 28px;border-radius:0;
  border-top:4px solid transparent;
  transition:border-color .3s,transform .4s,box-shadow .4s;
  cursor:pointer;
}
.af-kres-card:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.08)}
.af-kres-card.c1{background:var(--kd-sky);}.af-kres-card.c1:hover{border-color:#3B82F6}
.af-kres-card.c2{background:var(--kd-sun);}.af-kres-card.c2:hover{border-color:var(--kd-gold)}
.af-kres-card.c3{background:var(--kd-mint);}.af-kres-card.c3:hover{border-color:var(--kd-teal)}
.af-kres-card.c4{background:var(--kd-rose);}.af-kres-card.c4:hover{border-color:var(--kd-coral)}
.af-kres-card.c5{background:#F3EFFF;}.af-kres-card.c5:hover{border-color:var(--kd-purple)}
.af-kres-card.c6{background:#FFF8E6;}.af-kres-card.c6:hover{border-color:#D97706}
.af-kres-icon{font-size:38px;margin-bottom:18px;display:block}
.af-kres-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:var(--kd-ink);margin:0 0 10px;
}
.af-kres-desc{
  font-family:'Jost',sans-serif;font-size:13px;
  color:var(--kd-stone);line-height:1.65;
  font-weight:300;margin:0 0 20px;
}
.af-kres-link{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  color:var(--kd-navy);font-weight:600;
  text-decoration:none;transition:gap .2s;
  display:inline-flex;align-items:center;gap:6px;
}
.af-kres-link:hover{gap:12px;text-decoration:none}

/* ── PARENTS TIP v2 ── */
.af-kids-parents{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--kd-navy);
  padding:96px 56px;box-sizing:border-box;
}
.af-kids-parents-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1100px;margin:0 auto;
}
.af-kids-parents-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(32px,4vw,56px);
  font-weight:300;color:#fff;
  margin:0 0 20px;line-height:1.1;
}
.af-kids-parents-title em{font-style:italic;color:#F5C842}
.af-kids-parents-desc{
  font-family:'Jost',sans-serif;font-size:15px;
  color:rgba(255,255,255,.65);line-height:1.75;
  font-weight:300;margin:0 0 32px;
}
.af-kids-tip-box{
  background:rgba(245,200,66,.08);
  border:1px solid rgba(245,200,66,.25);
  padding:40px;
}
.af-kids-tip-label{
  font-family:'Jost',sans-serif;font-size:10px;
  letter-spacing:.2em;text-transform:uppercase;
  color:#F5C842;font-weight:600;
  display:inline-block;margin-bottom:16px;
}
.af-kids-tip-quote{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:300;font-style:italic;
  color:rgba(255,255,255,.88);line-height:1.6;margin:0;
}

/* ── WHY v2 ── */
.af-kids-why-v2{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--kd-sky);
  padding:96px 56px;box-sizing:border-box;
}
.af-kids-why-v2-inner{
  max-width:900px;margin:0 auto;text-align:center;
}
.af-kids-why-v2-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(30px,4vw,52px);font-weight:300;
  color:var(--kd-ink);margin:0 0 20px;
}
.af-kids-why-v2-desc{
  font-family:'Jost',sans-serif;font-size:16px;
  color:var(--kd-stone);line-height:1.78;
  font-weight:300;margin:0 auto 56px;max-width:660px;
}
.af-kids-pillars{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:24px;text-align:left;
}
.af-kids-pillar{
  background:#fff;padding:32px 28px;
  border-bottom:3px solid transparent;
  transition:border-color .3s,transform .3s;
}
.af-kids-pillar:hover{border-color:var(--kd-gold);transform:translateY(-4px)}
.af-kids-pillar-icon{font-size:32px;margin-bottom:14px;display:block}
.af-kids-pillar-title{
  font-family:'Cormorant Garamond',serif;
  font-size:20px;font-weight:400;
  color:var(--kd-ink);margin:0 0 8px;
}
.af-kids-pillar-desc{
  font-family:'Jost',sans-serif;font-size:13px;
  color:var(--kd-stone);line-height:1.6;font-weight:300;margin:0;
}

/* RESPONSIVE */
@media(max-width:768px){
  .af-kids-hero-v2-inner,.af-kids-featured-inner,.af-kids-parents-inner{grid-template-columns:1fr;gap:40px}
  .af-kids-resources-v2-grid,.af-age-panel.active,.af-kids-pillars{grid-template-columns:1fr}
  .af-kids-hero-v2,.af-kids-verse,.af-kids-ages,.af-kids-featured,.af-kids-resources-v2,.af-kids-parents,.af-kids-why-v2{padding-left:24px;padding-right:24px}
  .af-kids-hero-v2-img{display:none}
}
</style>
<?php }

/* ── [af_kids_hero_v2] ── */
add_shortcode('af_kids_hero_v2','af_kids_hero_v2_shortcode');
function af_kids_hero_v2_shortcode(){
    ob_start();?>
    <div class="af-kids-hero-v2">
      <div class="af-kids-hero-v2-inner">
        <div class="af-reveal">
          <span class="af-kids-tag">✦ For Kids & Families</span>
          <h1 class="af-kids-hero-v2-title">Building Faith in<br><em>Little Hearts</em></h1>
          <p class="af-kids-hero-v2-desc">Helping children build faith in Jesus Christ can be joyful, simple, and deeply meaningful. Trusted resources designed to help children learn the gospel and develop a love for Jesus Christ.</p>
          <div class="af-kids-hero-v2-btns">
            <a href="#resources" class="af-kids-btn-primary">Explore Resources →</a>
            <a href="#ages" class="af-kids-btn-ghost">Find by Age</a>
          </div>
        </div>
        <div class="af-kids-hero-v2-img af-reveal-right af-d2">
          <img src="/wp-content/uploads/2026/01/jesus_holding_children_phyllis_luch.webp" alt="Jesus with children"/>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_kids_verse] ── */
add_shortcode('af_kids_verse','af_kids_verse_shortcode');
function af_kids_verse_shortcode(){
    ob_start();?>
    <div class="af-kids-verse af-reveal">
      <div class="af-kids-verse-inner">
        <span class="af-kids-verse-label">✦ Scripture of the Week ✦</span>
        <p class="af-kids-verse-text">"I can do all things through Christ which strengtheneth me."</p>
        <p class="af-kids-verse-ref">Philippians 4:13</p>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_kids_ages] ── */
add_shortcode('af_kids_ages','af_kids_ages_shortcode');
function af_kids_ages_shortcode(){
    $ages = [
        'Toddlers' => [
            ['icon'=>af_icon('music_notes',40,'currentColor'),'title'=>'Primary Songs','desc'=>'Simple faith songs that toddlers love to sing and repeat.','bg'=>'sky'],
            ['icon'=>af_icon('scriptures',40,'currentColor'),'title'=>'Picture Scriptures','desc'=>'Bright illustrated stories from the Bible and Book of Mormon.','bg'=>'sun'],
            ['icon'=>af_icon('prayer',40,'currentColor'),'title'=>'Simple Prayers','desc'=>'Teaching little ones to talk to Heavenly Father every day.','bg'=>'mint'],
        ],
        'Ages 4–7' => [
            ['icon'=>af_icon('book_of_mormon',40,'currentColor'),'title'=>'Scripture Stories','desc'=>'Illustrated Book of Mormon and Bible stories for early readers.','bg'=>'sky'],
            ['icon'=>af_icon('paint',40,'currentColor'),'title'=>'Activity Pages','desc'=>'Faith-based colouring and activity sheets for young children.','bg'=>'rose'],
            ['icon'=>af_icon('tv_screen',40,'currentColor'),'title'=>'Animated Videos','desc'=>'Short animated scripture stories that bring the gospel to life.','bg'=>'mint'],
        ],
        'Ages 8–11' => [
            ['icon'=>af_icon('journal',40,'currentColor'),'title'=>'Scripture Journal','desc'=>'A guided journal to record personal faith experiences and lessons.','bg'=>'sun'],
            ['icon'=>af_icon('newspaper',40,'currentColor'),'title'=>'The Friend Magazine','desc'=>'Monthly stories, articles and activities for children aged 8–11.','bg'=>'sky'],
            ['icon'=>af_icon('come_follow_me',40,'currentColor'),'title'=>'Come Follow Me','desc'=>'Weekly family scripture study resources aligned to curriculum.','bg'=>'mint'],
        ],
        'Youth 12+' => [
            ['icon'=>af_icon('microphone',40,'currentColor'),'title'=>'Youth Podcasts','desc'=>'Faith conversations and testimonies made for young adults.','bg'=>'rose'],
            ['icon'=>af_icon('journal',40,'currentColor'),'title'=>'Living Scriptures','desc'=>'Professionally animated scripture stories for older youth.','bg'=>'sky'],
            ['icon'=>af_icon('testimony',40,'currentColor'),'title'=>'Testimony Tools','desc'=>'Resources to help youth develop and share their own testimony.','bg'=>'sun'],
        ],
    ];
    ob_start();?>
    <div class="af-kids-ages" id="ages">
      <div class="af-kids-ages-header af-reveal">
        <h2>Resources by Age Group</h2>
        <p>Every child is different. Find resources that fit right where your child is.</p>
      </div>
      <div class="af-age-tabs af-reveal af-d2">
        <?php $first=true; foreach($ages as $label=>$cards):?>
        <button class="af-age-tab<?php echo $first?' active':'';?>" onclick="afAgeTab(this,'<?php echo esc_js($label);?>')"><?php echo esc_html($label);?></button>
        <?php $first=false; endforeach;?>
      </div>
      <?php $first=true; foreach($ages as $label=>$cards):?>
      <div class="af-age-panel<?php echo $first?' active':'';?>" id="af-age-<?php echo esc_attr(str_replace([' ','–'],['','-'],$label));?>">
        <?php foreach($cards as $c):?>
        <div class="af-age-card <?php echo $c['bg'];?> af-reveal">
          <span class="af-age-card-icon"><?php echo $c['icon'];?></span>
          <h3 class="af-age-card-title"><?php echo esc_html($c['title']);?></h3>
          <p class="af-age-card-desc"><?php echo esc_html($c['desc']);?></p>
        </div>
        <?php endforeach;?>
      </div>
      <?php $first=false; endforeach;?>
    </div>
    <script>
    function afAgeTab(btn,label){
      document.querySelectorAll('.af-age-tab').forEach(t=>t.classList.remove('active'));
      document.querySelectorAll('.af-age-panel').forEach(p=>p.classList.remove('active'));
      btn.classList.add('active');
      var id='af-age-'+label.replace(/\s/g,'').replace('–','-');
      var panel=document.getElementById(id);
      if(panel){panel.classList.add('active');}
    }
    </script>
    <?php return ob_get_clean();
}

/* ── [af_kids_featured] ── */
add_shortcode('af_kids_featured','af_kids_featured_shortcode');
function af_kids_featured_shortcode(){
    ob_start();?>
    <div class="af-kids-featured">
      <div class="af-kids-featured-inner">
        <div class="af-kids-featured-img af-reveal-left">📖</div>
        <div class="af-reveal-right af-d2">
          <span class="af-kids-featured-badge">⭐ Featured Resource</span>
          <h2 class="af-kids-featured-title">The Friend Magazine</h2>
          <p class="af-kids-featured-desc">A beloved monthly magazine created specifically for children. Packed with faith promoting stories, gospel teachings, activities, and illustrations — The Friend has been nurturing faith in children for generations. Trusted by Latter-day Saint families worldwide.</p>
          <a href="#" class="af-kids-btn-primary" style="background:var(--kd-teal);border-color:var(--kd-teal)">Visit The Friend →</a>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_kids_resources_v2] ── */
add_shortcode('af_kids_resources_v2','af_kids_resources_v2_shortcode');
function af_kids_resources_v2_shortcode(){
    $res=[
        ['icon'=>af_icon('newspaper',40,'currentColor'),'title'=>'The Friend Magazine',    'desc'=>'Monthly stories and activities teaching gospel principles in simple language.','url'=>'#','c'=>'c1'],
        ['icon'=>af_icon('book_of_mormon',40,'currentColor'),'title'=>'Scripture Stories',      'desc'=>'Illustrated Bible and Book of Mormon stories for visual learners.','url'=>'#','c'=>'c2'],
        ['icon'=>af_icon('tv_screen',40,'currentColor'),'title'=>'Videos & Music for Kids','desc'=>'Visual and audio resources connecting children to gospel principles.','url'=>'#','c'=>'c3'],
        ['icon'=>af_icon('play',40,'currentColor'),'title'=>'Animated Scripture',     'desc'=>'Animated videos bringing scripture stories to life for children.','url'=>'#','c'=>'c4'],
        ['icon'=>af_icon('journal',40,'currentColor'),'title'=>'Living Scriptures',      'desc'=>'Professionally animated stories used by families worldwide.','url'=>'#','c'=>'c5'],
        ['icon'=>af_icon('music_notes',40,'currentColor'),'title'=>'Primary Songs & Music',  'desc'=>'Faith based music helping children learn gospel truths through melody.','url'=>'#','c'=>'c6'],
    ];
    ob_start();?>
    <div class="af-kids-resources-v2" id="resources">
      <div class="af-kids-resources-v2-header af-reveal">
        <h2>Core Kids Faith Resources</h2>
        <p>Foundational resources trusted by Latter-day Saint families, designed specifically for children.</p>
      </div>
      <div class="af-kids-resources-v2-grid">
        <?php foreach($res as $i=>$r):?>
        <div class="af-kres-card <?php echo $r['c'];?> af-reveal af-d<?php echo min($i%3+1,3);?>">
          <span class="af-kres-icon"><?php echo $r['icon'];?></span>
          <h3 class="af-kres-title"><?php echo esc_html($r['title']);?></h3>
          <p class="af-kres-desc"><?php echo esc_html($r['desc']);?></p>
          <a href="<?php echo esc_url($r['url']);?>" class="af-kres-link">Explore →</a>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_kids_parents_v2] ── */
add_shortcode('af_kids_parents_v2','af_kids_parents_v2_shortcode');
function af_kids_parents_v2_shortcode(){
    ob_start();?>
    <div class="af-kids-parents">
      <div class="af-kids-parents-inner">
        <div class="af-reveal-left">
          <h2 class="af-kids-parents-title">A Note for<br><em>Parents</em></h2>
          <p class="af-kids-parents-desc">You are your child's greatest teacher of faith. These resources are tools to support you — not replace the sacred moments you create together at home. Even five minutes a day of scripture reading, prayer, or singing a Primary song can shape a child's faith for a lifetime.</p>
          <a href="#" class="af-kids-btn-primary">Family Study Guide →</a>
        </div>
        <div class="af-kids-tip-box af-reveal-right af-d2">
          <span class="af-kids-tip-label">✦ Tip for Parents</span>
          <p class="af-kids-tip-quote">"Faith grows best through consistency, not perfection. Simple daily moments — bedtime stories, music during routines, short conversations — make a lasting spiritual impact."</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_kids_why_v2] ── */
add_shortcode('af_kids_why_v2','af_kids_why_v2_shortcode');
function af_kids_why_v2_shortcode(){
    $pillars=[
        ['icon'=>af_icon('heart',40,'currentColor'),'title'=>'Relationship with Christ','desc'=>'Resources that help children see Jesus as a friend and Saviour, not just a historical figure.'],
        ['icon'=>af_icon('anchor',40,'currentColor'),'title'=>'Growing Testimonies','desc'=>'Age-appropriate tools that grow with your child from toddler to teenager.'],
        ['icon'=>af_icon('home',40,'currentColor'),'title'=>'Home Centred Faith','desc'=>'Everything here is designed to strengthen gospel learning in the home, not replace it.'],
    ];
    ob_start();?>
    <div class="af-kids-why-v2">
      <div class="af-kids-why-v2-inner">
        <div class="af-reveal">
          <h2 class="af-kids-why-v2-title">Why Kids Faith Resources Matter</h2>
          <p class="af-kids-why-v2-desc">Faith centred resources help children build a relationship with Jesus Christ, recognise the Spirit, and understand gospel truths in ways that grow with them throughout their lives.</p>
        </div>
        <div class="af-kids-pillars">
          <?php foreach($pillars as $i=>$p):?>
          <div class="af-kids-pillar af-reveal af-d<?php echo $i+1;?>">
            <span class="af-kids-pillar-icon"><?php echo $p['icon'];?></span>
            <h3 class="af-kids-pillar-title"><?php echo esc_html($p['title']);?></h3>
            <p class="af-kids-pillar-desc"><?php echo esc_html($p['desc']);?></p>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── KIDS ANIMATION CSS ── */
add_action('wp_head','af_kids_anim_css',104);
function af_kids_anim_css(){ ?>
<style id="af-kids-anim">

/* Sparkle dots on scripture */
@keyframes af-sparkle{
  0%,100%{opacity:0;transform:scale(0) translateY(0)}
  50%{opacity:.7;transform:scale(1) translateY(-8px)}
}

/* Shine sweep on badge */
.af-kids-featured-badge{position:relative;overflow:hidden}
.af-kids-featured-badge::after{
  content:'';position:absolute;
  top:0;left:-100%;
  width:60%;height:100%;
  background:rgba(255,255,255,.3);
  transform:skewX(-20deg);
  transition:none;
}
.af-kids-featured-badge.af-shine::after{
  transition:left .5s ease;
  left:150%;
}

/* Bounce on age tab active */
.af-age-tab.active{
  animation:af-tab-pop .3s cubic-bezier(.34,1.56,.64,1);
}
@keyframes af-tab-pop{
  0%{transform:scale(.95)}
  100%{transform:scale(1)}
}

/* Gentle pulse on scripture label */
.af-kids-verse-label{
  animation:af-pulse-label 3s ease-in-out infinite;
}
@keyframes af-pulse-label{
  0%,100%{opacity:1;letter-spacing:.2em}
  50%{opacity:.7;letter-spacing:.26em}
}

/* Kids hero tag float */
.af-kids-tag{
  animation:af-tag-float 4s ease-in-out infinite;
}
@keyframes af-tag-float{
  0%,100%{transform:translateY(0)}
  50%{transform:translateY(-4px)}
}

/* Resource card colour pulse on hover */
.af-kres-card.c1:hover{box-shadow:0 20px 48px rgba(59,130,246,.15)}
.af-kres-card.c2:hover{box-shadow:0 20px 48px rgba(212,151,42,.15)}
.af-kres-card.c3:hover{box-shadow:0 20px 48px rgba(15,123,108,.15)}
.af-kres-card.c4:hover{box-shadow:0 20px 48px rgba(217,95,59,.15)}
.af-kres-card.c5:hover{box-shadow:0 20px 48px rgba(107,75,181,.15)}
.af-kres-card.c6:hover{box-shadow:0 20px 48px rgba(217,119,6,.15)}

/* Pillar card border colour animation */
.af-kids-pillar:nth-child(1):hover{border-color:#EF4444}
.af-kids-pillar:nth-child(2):hover{border-color:var(--kd-teal)}
.af-kids-pillar:nth-child(3):hover{border-color:var(--kd-purple)}

/* Tip box gentle glow */
.af-kids-tip-box{
  animation:af-tip-glow 5s ease-in-out infinite;
}
@keyframes af-tip-glow{
  0%,100%{box-shadow:0 0 0 0 rgba(245,200,66,0)}
  50%{box-shadow:0 0 32px 0 rgba(245,200,66,.12)}
}

/* Featured image emoji bounce */
.af-kids-featured-img{
  animation:af-emoji-bounce 3s ease-in-out infinite;
  font-size:80px;
}
@keyframes af-emoji-bounce{
  0%,100%{transform:translateY(0) rotate(0deg)}
  25%{transform:translateY(-8px) rotate(-3deg)}
  75%{transform:translateY(-4px) rotate(3deg)}
}

/* Page load entrance for hero content */
.af-kids-hero-v2 .af-kids-tag{
  animation:af-slide-down .8s cubic-bezier(.16,1,.3,1) .2s both;
}
.af-kids-hero-v2 .af-kids-hero-v2-desc{
  animation:af-fade-up .9s cubic-bezier(.16,1,.3,1) .6s both;
}
.af-kids-hero-v2 .af-kids-hero-v2-btns{
  animation:af-fade-up .9s cubic-bezier(.16,1,.3,1) .8s both;
}
@keyframes af-slide-down{
  from{opacity:0;transform:translateY(-16px)}
  to{opacity:1;transform:translateY(0)}
}
@keyframes af-fade-up{
  from{opacity:0;transform:translateY(20px)}
  to{opacity:1;transform:translateY(0)}
}

/* Age panel transition */
.af-age-panel{
  animation:af-panel-in .45s cubic-bezier(.16,1,.3,1);
}
@keyframes af-panel-in{
  from{opacity:0;transform:translateY(16px)}
  to{opacity:1;transform:translateY(0)}
}

/* Respect reduced motion */
@media(prefers-reduced-motion:reduce){
  *{animation:none!important;transition:none!important}
}
</style>
<?php }

/* ============================================================
   PODCASTS PAGE — all shortcodes
   ============================================================ */

/* ── PODCASTS CSS ── */
add_action('wp_head','af_podcast_css',105);
function af_podcast_css(){ ?>
<style id="af-podcast-css">

/* ── PODCAST HERO ── */
.af-pod-hero{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:110px 56px 100px;box-sizing:border-box;
  overflow:hidden;
}
.af-pod-hero::before{
  content:'';position:absolute;
  top:-200px;right:-200px;
  width:600px;height:600px;border-radius:50%;
  background:rgba(184,151,90,.06);
  animation:af-pod-orb 12s ease-in-out infinite alternate;
}
.af-pod-hero::after{
  content:'';position:absolute;
  bottom:-150px;left:-100px;
  width:400px;height:400px;border-radius:50%;
  background:rgba(27,51,86,.6);
}
@keyframes af-pod-orb{
  0%{transform:scale(1) translate(0,0)}
  100%{transform:scale(1.2) translate(-40px,40px)}
}
.af-pod-hero-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;position:relative;z-index:1;
}
.af-pod-eyebrow{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.22em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;
  display:flex;align-items:center;gap:12px;margin-bottom:20px;
}
.af-pod-eyebrow::before{content:'';display:block;width:32px;height:1px;background:var(--af-gold)}
.af-pod-hero-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(44px,6vw,80px);
  font-weight:300;line-height:1.03;
  color:#fff;margin:0 0 24px;
}
.af-pod-hero-title em{font-style:italic;color:var(--af-gold-light)}
.af-pod-hero-desc{
  font-family:'Jost',sans-serif;font-size:15px;
  color:rgba(255,255,255,.65);line-height:1.78;
  font-weight:300;margin:0 0 40px;max-width:460px;
}
.af-pod-platforms-row{display:flex;gap:12px;flex-wrap:wrap}
.af-pod-platform-btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:12px 22px;
  border:1px solid rgba(255,255,255,.2);
  color:rgba(255,255,255,.8);
  font-family:'Jost',sans-serif;font-size:12px;
  font-weight:500;text-decoration:none;
  transition:all .3s;
}
.af-pod-platform-btn:hover{
  border-color:var(--af-gold);
  color:var(--af-gold-light);
  transform:translateY(-2px);
  text-decoration:none;
}
.af-pod-platform-btn.primary{
  background:var(--af-gold);border-color:var(--af-gold);color:#fff;
}
.af-pod-platform-btn.primary:hover{background:transparent;color:var(--af-gold-light)}

/* Hero visual — waveform */
.af-pod-hero-visual{
  display:flex;align-items:center;justify-content:center;
  position:relative;
}
.af-pod-waveform{
  display:flex;align-items:center;gap:5px;height:120px;
}
.af-pod-bar{
  width:6px;border-radius:3px;
  background:var(--af-gold);opacity:.7;
  animation:af-wave 1.4s ease-in-out infinite;
}
.af-pod-bar:nth-child(2n){background:rgba(255,255,255,.4);animation-delay:.1s}
.af-pod-bar:nth-child(3n){animation-delay:.2s;opacity:.5}
.af-pod-bar:nth-child(4n){animation-delay:.35s}
.af-pod-bar:nth-child(5n){animation-delay:.15s;opacity:.6}
@keyframes af-wave{
  0%,100%{height:20px}
  50%{height:80px}
}
.af-pod-hero-circle{
  position:absolute;
  width:280px;height:280px;border-radius:50%;
  border:1px solid rgba(184,151,90,.2);
  animation:af-pod-ring 8s linear infinite;
}
.af-pod-hero-circle:nth-child(2){
  width:340px;height:340px;
  border-color:rgba(184,151,90,.1);
  animation-direction:reverse;animation-duration:12s;
}
@keyframes af-pod-ring{
  from{transform:rotate(0deg)}
  to{transform:rotate(360deg)}
}

/* ── ABOUT ── */
.af-pod-about{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-cream2);
  padding:100px 56px;box-sizing:border-box;
}
.af-pod-about-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-pod-about-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(32px,4vw,54px);font-weight:300;
  color:var(--af-ink);margin:0 0 20px;line-height:1.1;
}
.af-pod-about-title em{font-style:italic;color:var(--af-gold)}
.af-pod-about-desc{
  font-family:'Jost',sans-serif;font-size:15px;
  color:var(--af-stone);line-height:1.78;
  font-weight:300;margin:0 0 16px;
}
.af-pod-stat-row{
  display:flex;gap:40px;margin-top:36px;flex-wrap:wrap;
}
.af-pod-stat{border-left:3px solid var(--af-gold);padding-left:16px}
.af-pod-stat-num{
  font-family:'Cormorant Garamond',serif;
  font-size:40px;font-weight:300;color:var(--af-gold);
  line-height:1;display:block;margin-bottom:4px;
}
.af-pod-stat-label{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  color:var(--af-stone);font-weight:500;
}
.af-pod-about-visual{
  background:var(--af-navy);
  padding:48px 40px;
  position:relative;overflow:hidden;
}
.af-pod-about-visual::before{
  content:'';position:absolute;
  top:-60px;right:-60px;width:180px;height:180px;
  border-radius:50%;background:rgba(184,151,90,.08);
}
.af-pod-quote{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(20px,2.5vw,28px);
  font-weight:300;font-style:italic;
  color:rgba(255,255,255,.9);line-height:1.55;
  margin:0 0 20px;position:relative;z-index:1;
}
.af-pod-quote-attr{
  font-family:'Jost',sans-serif;font-size:12px;
  letter-spacing:.14em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;
  position:relative;z-index:1;
}

/* ── EPISODES ── */
.af-pod-episodes{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:100px 56px;box-sizing:border-box;
}
.af-pod-episodes-header{margin-bottom:56px}
.af-pod-episodes-header h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(30px,4vw,52px);font-weight:300;
  color:#fff;margin:0 0 12px;
}
.af-pod-episodes-header p{
  font-family:'Jost',sans-serif;font-size:15px;
  color:rgba(255,255,255,.5);font-weight:300;margin:0;
}
.af-pod-episode-list{display:flex;flex-direction:column;gap:2px}
.af-pod-episode{
  display:grid;
  grid-template-columns:64px 1fr auto;
  gap:28px;align-items:center;
  padding:28px 32px;
  background:rgba(255,255,255,.03);
  border-left:3px solid transparent;
  cursor:pointer;
  transition:background .3s,border-color .3s,transform .3s;
}
.af-pod-episode:hover{
  background:rgba(255,255,255,.06);
  border-left-color:var(--af-gold);
  transform:translateX(4px);
}
.af-pod-ep-num{
  font-family:'Cormorant Garamond',serif;
  font-size:36px;font-weight:300;
  color:rgba(255,255,255,.15);line-height:1;
  text-align:center;
}
.af-pod-ep-tag{
  font-family:'Jost',sans-serif;font-size:10px;
  letter-spacing:.16em;text-transform:uppercase;
  color:var(--af-gold);font-weight:600;margin:0 0 6px;
}
.af-pod-ep-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:rgba(255,255,255,.9);margin:0 0 6px;line-height:1.3;
}
.af-pod-ep-desc{
  font-family:'Jost',sans-serif;font-size:13px;
  color:rgba(255,255,255,.45);line-height:1.5;
  font-weight:300;margin:0;
}
.af-pod-ep-meta{
  display:flex;flex-direction:column;align-items:flex-end;gap:8px;
  flex-shrink:0;
}
.af-pod-ep-duration{
  font-family:'Jost',sans-serif;font-size:12px;
  color:rgba(255,255,255,.35);font-weight:400;
}
.af-pod-ep-type{
  font-family:'Jost',sans-serif;font-size:10px;
  letter-spacing:.1em;text-transform:uppercase;
  padding:4px 10px;font-weight:500;
}
.af-pod-ep-type.audio{background:rgba(184,151,90,.15);color:var(--af-gold)}
.af-pod-ep-type.video{background:rgba(27,51,86,.5);color:#93C5FD}

/* ── PLATFORMS ── */
.af-pod-where{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy);
  padding:100px 56px;box-sizing:border-box;
  text-align:center;
}
.af-pod-where h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(30px,4vw,52px);font-weight:300;
  color:#fff;margin:0 0 14px;
}
.af-pod-where p{
  font-family:'Jost',sans-serif;font-size:15px;
  color:rgba(255,255,255,.55);font-weight:300;
  margin:0 0 56px;
}
.af-pod-platforms-grid{
  display:flex;justify-content:center;
  gap:24px;flex-wrap:wrap;
  max-width:900px;margin:0 auto;
}
.af-pod-plat-card{
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.1);
  padding:36px 32px;min-width:160px;
  display:flex;flex-direction:column;align-items:center;gap:14px;
  cursor:pointer;
  transition:all .3s;text-decoration:none;
}
.af-pod-plat-card:hover{
  border-color:var(--af-gold);
  background:rgba(255,255,255,.08);
  transform:translateY(-6px);
  text-decoration:none;
}
.af-pod-plat-icon{font-size:40px}
.af-pod-plat-name{
  font-family:'Jost',sans-serif;font-size:13px;
  font-weight:500;color:rgba(255,255,255,.8);
  letter-spacing:.06em;
}
.af-pod-plat-sub{
  font-family:'Jost',sans-serif;font-size:11px;
  color:rgba(255,255,255,.35);font-weight:300;
}

/* ANIMATIONS */
.af-pod-episode{
  opacity:0;transform:translateX(-24px);
  transition:opacity .6s cubic-bezier(.16,1,.3,1),
             transform .6s cubic-bezier(.16,1,.3,1),
             background .3s,border-color .3s;
}
.af-pod-episode.af-visible{opacity:1;transform:translateX(0)}
.af-pod-plat-card{
  opacity:0;transform:translateY(24px);
  transition:opacity .6s cubic-bezier(.16,1,.3,1),
             transform .6s cubic-bezier(.16,1,.3,1),
             border-color .3s,background .3s;
}
.af-pod-plat-card.af-visible{opacity:1;transform:translateY(0)}

/* RESPONSIVE */
@media(max-width:768px){
  .af-pod-hero-inner,.af-pod-about-inner{grid-template-columns:1fr;gap:48px}
  .af-pod-hero-visual{display:none}
  .af-pod-hero,.af-pod-about,.af-pod-episodes,.af-pod-where{padding-left:24px;padding-right:24px}
  .af-pod-episode{grid-template-columns:40px 1fr;gap:16px}
  .af-pod-ep-meta{display:none}
}
</style>
<?php }

/* ── [af_pod_hero] ── */
add_shortcode('af_pod_hero','af_pod_hero_shortcode');
function af_pod_hero_shortcode(){
    $bars = [90,40,70,55,85,35,65,80,45,75,50,90,38,68,82,42,72,58,88,44];
    ob_start();?>
    <div class="af-pod-hero">
      <div class="af-pod-hero-inner">
        <div class="af-reveal">
          <p class="af-pod-eyebrow">An Anchored Faith</p>
          <h1 class="af-pod-hero-title">The <em>Podcast</em></h1>
          <p class="af-pod-hero-desc">Faith-centred conversations, testimonies, evidences of the Restoration, and gospel insights — available on YouTube and your favourite podcast platforms. New episodes every week.</p>
          <div class="af-pod-platforms-row">
            <a href="#" class="af-pod-platform-btn primary">▶ Watch on YouTube</a>
            <a href="#" class="af-pod-platform-btn">♫ Spotify</a>
            <a href="#" class="af-pod-platform-btn">🎙 Apple Podcasts</a>
          </div>
        </div>
        <div class="af-pod-hero-visual af-reveal-right af-d2">
          <div class="af-pod-hero-circle"></div>
          <div class="af-pod-hero-circle"></div>
          <div class="af-pod-waveform">
            <?php foreach($bars as $i=>$h):?>
            <div class="af-pod-bar" style="height:<?php echo $h;?>px;animation-delay:<?php echo ($i*0.07);?>s"></div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_pod_about] ── */
add_shortcode('af_pod_about','af_pod_about_shortcode');
function af_pod_about_shortcode(){
    ob_start();?>
    <div class="af-pod-about">
      <div class="af-pod-about-inner">
        <div class="af-reveal-left">
          <p class="af-eyebrow" style="color:var(--af-gold)">About the Podcast</p>
          <h2 class="af-pod-about-title">Conversations That<br><em>Strengthen Faith</em></h2>
          <p class="af-pod-about-desc">An Anchored Faith podcast brings together testimonies, evidences of the Restoration, gospel insights, and lived faith experiences — all centred on Jesus Christ.</p>
          <p class="af-pod-about-desc">Whether you are a lifelong member, someone exploring the Church, or a parent looking for resources — every episode is designed to anchor your faith more deeply in Him.</p>
          <div class="af-pod-stat-row">
            <div class="af-pod-stat">
              <span class="af-pod-stat-num af-count" data-count="24">0</span>
              <span class="af-pod-stat-label">Episodes</span>
            </div>
            <div class="af-pod-stat">
              <span class="af-pod-stat-num af-count" data-count="3">0</span>
              <span class="af-pod-stat-label">Platforms</span>
            </div>
            <div class="af-pod-stat">
              <span class="af-pod-stat-num af-count" data-count="5">0</span>
              <span class="af-pod-stat-label">Topics covered</span>
            </div>
          </div>
        </div>
        <div class="af-pod-about-visual af-reveal-right af-d2">
          <p class="af-pod-quote">"We have this hope as an anchor for the soul, firm and secure — and that is the message at the heart of every episode."</p>
          <p class="af-pod-quote-attr">— An Anchored Faith Podcast</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_pod_episodes] ── */
add_shortcode('af_pod_episodes','af_pod_episodes_shortcode');
function af_pod_episodes_shortcode(){
    $episodes = [
        ['num'=>'01','tag'=>'Conversão','title'=>'Episódio 2: O Meu Caminho à Conversão | Keymen Sweetness','desc'=>'Uma história poderosa de fé e conversão ao evangelho de Jesus Cristo.','duration'=>'18:44','type'=>'video','url'=>'https://www.youtube.com/watch?v=qZS7UAe98r4'],
        ['num'=>'02','tag'=>'Testemunho','title'=>'Como a Fé Transformou Angelo Nhantumbo','desc'=>'An Anchored Faith Podcast — uma testemunha pessoal de como a fé muda vidas.','duration'=>'0:54','type'=>'video','url'=>'https://www.youtube.com/watch?v=KYYVpLLE37g'],
        ['num'=>'03','tag'=>'Conferência Geral','title'=>'Como Enfrentar os Desafios do Mundo Atual','desc'=>'Reflexões sobre a Conferência Geral de Outubro 2015 e mensagens que fortalecem a fé.','duration'=>'3:56','type'=>'video','url'=>'https://www.youtube.com/watch?v=YUipuJF2daw'],
        ['num'=>'04','tag'=>'História','title'=>'The First Temple of Zimbabwe','desc'=>'A história do primeiro templo de Zimbabwe — um marco para os Santos dos Últimos Dias em África.','duration'=>'Coming Soon','type'=>'video','url'=>'https://www.youtube.com/@ananchoredfaith'],
    ];
    ob_start();?>
    <div class="af-pod-episodes">
      <div class="af-pod-episodes-header af-reveal">
        <p class="af-eyebrow" style="color:var(--af-gold)">Latest Episodes</p>
        <h2>Episode Listing</h2>
        <p>New episodes every week — faith conversations for every stage of your journey.</p>
      </div>
      <div class="af-pod-episode-list">
        <?php foreach($episodes as $ep):
          // Extract YouTube video ID from URL for thumbnail
          preg_match('/(?:v=|embed\/)([a-zA-Z0-9_-]{11})/', $ep['url'] ?? '', $m);
          $vid_id = $m[1] ?? '';
          $thumb  = $vid_id ? 'https://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg' : '';
        ?>
        <a href="<?php echo esc_url($ep['url'] ?? '#');?>" target="_blank" class="af-pod-episode" style="text-decoration:none">

          <?php if($thumb):?>
          <div class="af-pod-ep-thumb">
            <img src="<?php echo esc_url($thumb);?>" alt="<?php echo esc_attr($ep['title']);?>" loading="lazy"/>
            <div class="af-pod-ep-play">
              <svg width="20" height="20" viewBox="0 0 40 40" fill="white"><polygon points="14,10 14,30 32,20"/></svg>
            </div>
            <span class="af-pod-ep-dur-overlay"><?php echo esc_html($ep['duration']);?></span>
          </div>
          <?php else:?>
          <div class="af-pod-ep-num"><?php echo esc_html($ep['num']);?></div>
          <?php endif;?>

          <div class="af-pod-ep-body">
            <p class="af-pod-ep-tag"><?php echo esc_html($ep['tag']);?></p>
            <h3 class="af-pod-ep-title"><?php echo esc_html($ep['title']);?></h3>
            <p class="af-pod-ep-desc"><?php echo esc_html($ep['desc']);?></p>
          </div>
          <div class="af-pod-ep-meta">
            <span class="af-pod-ep-type <?php echo $ep['type'];?>"><?php echo esc_html($ep['type']);?></span>
            <span class="af-pod-ep-watch">Watch →</span>
          </div>
        </a>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_pod_where] ── */
add_shortcode('af_pod_where','af_pod_where_shortcode');
function af_pod_where_shortcode(){
    $platforms = [
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><rect x="4" y="6" width="32" height="22" rx="2" stroke="white" stroke-width="1.8"/><polygon points="16,12 16,22 26,17" fill="white" opacity=".9"/><line x1="14" y1="28" x2="12" y2="36" stroke="white" stroke-width="1.6" stroke-linecap="round"/><line x1="26" y1="28" x2="28" y2="36" stroke="white" stroke-width="1.6" stroke-linecap="round"/><line x1="10" y1="36" x2="30" y2="36" stroke="white" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'name'  => 'YouTube',
            'sub'   => 'Watch our episodes free',
            'url'   => 'https://youtube.com/@ananchoredfaith?si=qjHU4hT-lvgE7KL9',
            'color' => '#FF0000',
        ],
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="16" stroke="white" stroke-width="1.8"/><path d="M11 16 Q20 12 29 16" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M12 22 Q20 18 28 22" stroke="white" stroke-width="1.6" stroke-linecap="round"/><path d="M13 28 Q20 24 27 28" stroke="white" stroke-width="1.4" stroke-linecap="round"/></svg>',
            'name'  => 'Spotify',
            'sub'   => 'Stream audio episodes',
            'url'   => '#',
            'color' => '#1DB954',
        ],
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><rect x="4" y="4" width="32" height="32" rx="8" stroke="white" stroke-width="1.8"/><circle cx="20" cy="16" r="5" stroke="white" stroke-width="1.6"/><path d="M14 28 C14 24 26 24 26 28" stroke="white" stroke-width="1.6" stroke-linecap="round"/><line x1="20" y1="21" x2="20" y2="28" stroke="white" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'name'  => 'Apple Podcasts',
            'sub'   => 'Subscribe free on iOS',
            'url'   => '#',
            'color' => '#8B5CF6',
        ],
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><rect x="14" y="4" width="12" height="20" rx="6" stroke="white" stroke-width="1.8"/><path d="M8 22 Q8 34 20 34 Q32 34 32 22" stroke="white" stroke-width="1.8" stroke-linecap="round"/><line x1="20" y1="34" x2="20" y2="39" stroke="white" stroke-width="1.8" stroke-linecap="round"/><line x1="14" y1="39" x2="26" y2="39" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>',
            'name'  => 'Amazon Music',
            'sub'   => 'Listen on Amazon',
            'url'   => '#',
            'color' => '#00A8E1',
        ],
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><path d="M8 22 C8 12 13 6 20 6 C27 6 32 12 32 22" stroke="white" stroke-width="1.8" stroke-linecap="round"/><rect x="4" y="22" width="8" height="12" rx="3" stroke="white" stroke-width="1.6"/><rect x="28" y="22" width="8" height="12" rx="3" stroke="white" stroke-width="1.6"/></svg>',
            'name'  => 'Google Podcasts',
            'sub'   => 'Stream on Google',
            'url'   => '#',
            'color' => '#4285F4',
        ],
        [
            'icon'  => '<svg width="52" height="52" viewBox="0 0 40 40" fill="none"><path d="M20 4 C14 10 8 18 10 26 C12 32 16 36 20 37 C24 36 28 32 30 26 C32 18 26 10 20 4Z" stroke="white" stroke-width="1.8"/><path d="M20 16 C17 20 16 24 17 28 C18 31 19 32 20 32 C21 32 22 31 23 28 C24 24 23 20 20 16Z" fill="white" opacity=".5"/></svg>',
            'name'  => 'Our Channel',
            'sub'   => 'Subscribe & stay anchored',
            'url'   => 'https://youtube.com/@ananchoredfaith',
            'color' => '#B8975A',
        ],
    ];
    ob_start();?>
    <div class="af-pod-where">
      <div class="af-reveal">
        <p class="af-eyebrow" style="justify-content:center;color:var(--af-gold)">Listen Anywhere</p>
        <h2>Where to <em>Watch & Listen</em></h2>
        <p>Subscribe on your favourite platform and never miss an episode.</p>
      </div>

      <!-- Channel highlight -->
      <div class="af-pod-channel-banner af-reveal af-d2">
        <div class="af-pod-channel-left">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="4" y="6" width="32" height="22" rx="2" stroke="#FF0000" stroke-width="2"/><polygon points="16,12 16,22 26,17" fill="#FF0000"/></svg>
          <div>
            <p class="af-pod-channel-label">Our YouTube Channel</p>
            <p class="af-pod-channel-name">@ananchoredfaith</p>
          </div>
        </div>
        <a href="https://youtube.com/@ananchoredfaith?si=qjHU4hT-lvgE7KL9" target="_blank" class="af-pod-channel-btn">
          Subscribe Now →
        </a>
      </div>

      <div class="af-pod-platforms-grid">
        <?php foreach($platforms as $i=>$p):?>
        <a href="<?php echo esc_url($p['url']);?>" target="_blank" class="af-pod-plat-card af-d<?php echo min($i%3+1,3);?>" style="--plat-color:<?php echo esc_attr($p['color']);?>">
          <span class="af-pod-plat-icon"><?php echo $p['icon'];?></span>
          <span class="af-pod-plat-name"><?php echo esc_html($p['name']);?></span>
          <span class="af-pod-plat-sub"><?php echo esc_html($p['sub']);?></span>
        </a>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── GLOBAL FONT SIZE BOOST ── */
add_action('wp_head','af_font_boost',200);
function af_font_boost(){ ?>
<style id="af-font-boost">

/* ── SHARED LABELS & EYEBROWS ── */
.af-eyebrow,
.af-pod-eyebrow,
.af-kids-verse-label,
.af-kids-tag,
.af-pod-ep-tag,
.af-video-channel,
.af-card-tag,
.af-centered-eyebrow,
.af-kids-featured-badge,
.af-pod-quote-attr,
.af-pod-plat-sub,
.af-pod-stat-label { font-size:13px !important; letter-spacing:.16em !important; }

/* ── BODY / DESC TEXT ── */
.af-slide-desc,
.af-kids-hero-v2-desc,
.af-kids-hero-desc,
.af-pod-hero-desc,
.af-pod-about-desc,
.af-kids-parents-desc,
.af-kids-why-v2-desc,
.af-resources-desc,
.af-section-sub,
.af-kids-section-sub,
.af-kids-featured-desc,
.af-pod-episodes-header p,
.af-pod-where p,
.af-centered-desc { font-size:17px !important; line-height:1.85 !important; }

/* ── CARD DESCRIPTIONS ── */
.af-card-desc,
.af-kids-card-desc,
.af-kres-desc,
.af-age-card-desc,
.af-activity-desc,
.af-kids-pillar-desc,
.af-pod-ep-desc,
.af-pod-plat-name,
.af-kids-why-desc { font-size:15px !important; line-height:1.7 !important; }

/* ── CARD TITLES ── */
.af-card-title,
.af-kids-card-title,
.af-kres-title,
.af-age-card-title,
.af-activity-title,
.af-kids-pillar-title,
.af-video-title,
.af-pod-ep-title { font-size:26px !important; }

/* ── SECTION TITLES ── */
.af-section-title,
.af-kids-ages-header h2,
.af-kids-resources-v2-header h2,
.af-pod-episodes-header h2,
.af-pod-where h2 { font-size:clamp(36px,4.5vw,58px) !important; }

/* ── HERO TITLES ── */
.af-slide-title { font-size:clamp(56px,7.5vw,96px) !important; }
.af-kids-hero-v2-title { font-size:clamp(52px,6.5vw,88px) !important; }
.af-pod-hero-title { font-size:clamp(52px,7vw,92px) !important; }

/* ── CALLOUT TITLES ── */
.af-centered-title { font-size:clamp(44px,6vw,76px) !important; }
.af-pod-about-title { font-size:clamp(38px,4.5vw,62px) !important; }
.af-kids-parents-title { font-size:clamp(38px,4.5vw,62px) !important; }
.af-kids-why-v2-title { font-size:clamp(36px,4vw,58px) !important; }
.af-kids-featured-title { font-size:clamp(38px,4.5vw,60px) !important; }

/* ── SCRIPTURE ── */
.af-scripture blockquote { font-size:clamp(22px,3vw,34px) !important; }
.af-kids-verse-text { font-size:clamp(34px,5vw,58px) !important; }
.af-kids-tip-quote,
.af-pod-quote { font-size:clamp(20px,2.5vw,28px) !important; }

/* ── MARQUEE ── */
.af-marquee-item { font-size:20px !important; }

/* ── BUTTONS ── */
.af-btn-gold,
.af-btn-outline,
.af-btn-gold-lg,
.af-kids-btn-primary,
.af-kids-btn-ghost,
.af-pod-platform-btn { font-size:13px !important; letter-spacing:.12em !important; }

/* ── EPISODE LIST ── */
.af-pod-ep-num { font-size:44px !important; }
.af-pod-ep-duration { font-size:14px !important; }
.af-pod-ep-type { font-size:12px !important; }

/* ── STATS ── */
.af-pod-stat-num { font-size:52px !important; }

/* ── RESOURCE / PODCAST CARDS ── */
.af-kids-card-title,
.af-kres-title,
.af-pod-about-title { font-size:26px !important; }

/* ── FOOTER ── */
footer, .site-footer, #colophon {
  font-size:15px !important;
}
footer a, .site-footer a { font-size:15px !important; }

</style>
<?php }

/* ============================================================
   ABOUT US PAGE
   ============================================================ */

add_action('wp_head','af_about_css',106);
function af_about_css(){ ?>
<style id="af-about-css">

/* ── ABOUT HERO ── */
.af-about-hero{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  height:100vh;min-height:580px;
  overflow:hidden;box-sizing:border-box;
}
.af-about-hero-bg{
  position:absolute;inset:0;
  background-image:url('/wp-content/uploads/2025/12/degleex-ganzorig-wQImoykAwGs-unsplash-2-683x1024.jpg');
  background-size:cover;background-position:center;
  animation:af-kb 16s ease-in-out infinite alternate;
}
.af-about-hero-overlay{
  position:absolute;inset:0;
  background:linear-gradient(115deg,rgba(20,16,14,.85) 0%,rgba(20,16,14,.5) 55%,rgba(20,16,14,.2) 100%);
}
.af-about-hero-content{
  position:absolute;bottom:14%;left:9%;max-width:680px;z-index:10;
}
.af-about-hero-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(56px,7.5vw,96px);
  font-weight:300;line-height:1.03;
  color:#fff;margin:0 0 24px;
}
.af-about-hero-title em{font-style:italic;color:var(--af-gold-light)}
.af-about-hero-desc{
  font-family:'Jost',sans-serif;font-size:18px;
  color:rgba(255,255,255,.75);line-height:1.78;
  font-weight:300;margin:0 0 40px;max-width:520px;
}
.af-about-scroll-hint{
  position:absolute;bottom:40px;left:50%;transform:translateX(-50%);
  display:flex;flex-direction:column;align-items:center;gap:8px;
  color:rgba(255,255,255,.4);
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.18em;text-transform:uppercase;
  animation:af-bounce-hint 2s ease-in-out infinite;
}
.af-about-scroll-hint::after{
  content:'';display:block;width:1px;height:40px;
  background:rgba(255,255,255,.25);
}
@keyframes af-bounce-hint{
  0%,100%{transform:translateX(-50%) translateY(0)}
  50%{transform:translateX(-50%) translateY(8px)}
}

/* ── WHY WE EXIST ── */
.af-about-why{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-cream2);
  padding:110px 56px;box-sizing:border-box;
  overflow:hidden;
}
.af-about-why::before{
  content:'\201C';
  position:absolute;
  top:-40px;left:40px;
  font-family:'Cormorant Garamond',serif;
  font-size:320px;font-weight:300;
  color:rgba(184,151,90,.07);line-height:1;
  pointer-events:none;
}
.af-about-why-inner{
  max-width:1100px;margin:0 auto;
  display:grid;grid-template-columns:1fr 1.4fr;
  gap:100px;align-items:start;
}
.af-about-why-label{
  font-family:'Jost',sans-serif;font-size:13px;
  letter-spacing:.2em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;
  display:flex;align-items:center;gap:12px;margin-bottom:20px;
}
.af-about-why-label::before{content:'';display:block;width:28px;height:1px;background:var(--af-gold)}
.af-about-why-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(36px,4.5vw,58px);font-weight:300;
  color:var(--af-ink);line-height:1.08;margin:0;
  position:sticky;top:120px;
}
.af-about-why-title em{font-style:italic;color:var(--af-gold)}
.af-about-why-body p{
  font-family:'Jost',sans-serif;font-size:17px;
  color:var(--af-stone);line-height:1.85;
  font-weight:300;margin:0 0 28px;
}
.af-about-why-body p:last-child{margin:0}
.af-about-pull{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(22px,2.8vw,32px);
  font-weight:300;font-style:italic;
  color:var(--af-ink);line-height:1.45;
  border-left:3px solid var(--af-gold);
  padding-left:28px;margin:36px 0;
}

/* ── WHAT IT IS ── */
.af-about-what{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:110px 56px;box-sizing:border-box;
}
.af-about-what-inner{
  max-width:1100px;margin:0 auto;
  display:grid;grid-template-columns:1.4fr 1fr;
  gap:100px;align-items:center;
}
.af-about-what-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(36px,4.5vw,58px);font-weight:300;
  color:#fff;line-height:1.08;margin:0 0 28px;
}
.af-about-what-title em{font-style:italic;color:var(--af-gold-light)}
.af-about-what-desc{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.6);line-height:1.85;
  font-weight:300;margin:0 0 20px;
}
.af-about-pillars{
  display:flex;flex-direction:column;gap:2px;
}
.af-about-pillar{
  display:flex;align-items:flex-start;gap:20px;
  padding:28px 32px;
  background:rgba(255,255,255,.03);
  border-left:3px solid transparent;
  transition:background .3s,border-color .3s,transform .3s;
  cursor:default;
}
.af-about-pillar:hover{
  background:rgba(255,255,255,.06);
  border-left-color:var(--af-gold);
  transform:translateX(4px);
}
.af-about-pillar-icon{
  font-size:28px;flex-shrink:0;margin-top:2px;
}
.af-about-pillar-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:rgba(255,255,255,.9);margin:0 0 6px;
}
.af-about-pillar-desc{
  font-family:'Jost',sans-serif;font-size:14px;
  color:rgba(255,255,255,.45);line-height:1.6;
  font-weight:300;margin:0;
}

/* ── WHO IT'S FOR ── */
.af-about-who{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy);
  padding:110px 56px;box-sizing:border-box;
  text-align:center;
}
.af-about-who-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(36px,4.5vw,58px);font-weight:300;
  color:#fff;margin:0 0 20px;
}
.af-about-who-title em{font-style:italic;color:var(--af-gold-light)}
.af-about-who-desc{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.6);line-height:1.85;
  font-weight:300;max-width:680px;margin:0 auto 64px;
}
.af-about-who-cards{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:2px;background:rgba(255,255,255,.06);
  max-width:1100px;margin:0 auto;
}
.af-about-who-card{
  background:rgba(255,255,255,.03);
  padding:48px 36px;
  border-top:3px solid transparent;
  transition:background .3s,border-color .3s,transform .4s;
}
.af-about-who-card:hover{
  background:rgba(255,255,255,.07);
  border-color:var(--af-gold);
  transform:translateY(-6px);
}
.af-about-who-icon{font-size:44px;margin-bottom:20px;display:block}
.af-about-who-card-title{
  font-family:'Cormorant Garamond',serif;
  font-size:26px;font-weight:400;
  color:rgba(255,255,255,.9);margin:0 0 12px;
}
.af-about-who-card-desc{
  font-family:'Jost',sans-serif;font-size:15px;
  color:rgba(255,255,255,.45);line-height:1.7;
  font-weight:300;margin:0;
}

/* ── BELIEF ── */
.af-about-belief{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-gold-pale);
  padding:110px 56px;box-sizing:border-box;
  overflow:hidden;
}
.af-about-belief-inner{
  max-width:1100px;margin:0 auto;
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
}
.af-about-belief-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(36px,4.5vw,58px);font-weight:300;
  color:var(--af-ink);margin:0 0 28px;line-height:1.08;
}
.af-about-belief-title em{font-style:italic;color:var(--af-gold)}
.af-about-beliefs{display:flex;flex-direction:column;gap:20px}
.af-about-belief-item{
  display:flex;gap:16px;align-items:flex-start;
  padding:24px 28px;background:#fff;
  border-bottom:3px solid transparent;
  transition:border-color .3s,transform .3s,box-shadow .3s;
}
.af-about-belief-item:hover{
  border-color:var(--af-gold);
  transform:translateX(6px);
  box-shadow:0 8px 32px rgba(0,0,0,.06);
}
.af-about-belief-num{
  font-family:'Cormorant Garamond',serif;
  font-size:36px;font-weight:300;
  color:var(--af-gold);line-height:1;flex-shrink:0;
}
.af-about-belief-text{
  font-family:'Jost',sans-serif;font-size:16px;
  color:var(--af-stone);line-height:1.7;
  font-weight:300;margin:0;padding-top:6px;
}

/* ── CTA ── */
.af-about-cta{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:110px 56px;box-sizing:border-box;
  text-align:center;position:relative;overflow:hidden;
}
.af-about-cta::before{
  content:'';position:absolute;inset:0;
  opacity:.04;
  background-image:repeating-linear-gradient(45deg,var(--af-gold) 0,var(--af-gold) 1px,transparent 0,transparent 50%);
  background-size:28px 28px;
}
.af-about-cta-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(40px,5.5vw,72px);font-weight:300;
  color:#fff;margin:0 auto 20px;
  max-width:700px;line-height:1.05;position:relative;z-index:1;
}
.af-about-cta-title em{font-style:italic;color:var(--af-gold-light)}
.af-about-cta-desc{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.55);line-height:1.78;
  font-weight:300;max-width:520px;
  margin:0 auto 48px;position:relative;z-index:1;
}
.af-about-cta-btns{
  display:flex;justify-content:center;
  gap:16px;flex-wrap:wrap;
  position:relative;z-index:1;
}
.af-about-cta-btn{
  display:inline-flex;align-items:center;gap:10px;
  font-family:'Jost',sans-serif;font-size:13px;
  letter-spacing:.12em;text-transform:uppercase;
  font-weight:500;padding:16px 36px;
  text-decoration:none;transition:all .3s;
}
.af-about-cta-btn.gold{background:var(--af-gold);color:#fff;border:1px solid var(--af-gold)}
.af-about-cta-btn.gold:hover{background:transparent;color:var(--af-gold-light);text-decoration:none}
.af-about-cta-btn.ghost{border:1px solid rgba(255,255,255,.25);color:rgba(255,255,255,.8)}
.af-about-cta-btn.ghost:hover{border-color:#fff;color:#fff;text-decoration:none}

/* ABOUT PAGE ANIMATIONS */
.af-about-pillar,.af-about-who-card,.af-about-belief-item{
  opacity:0;transform:translateY(24px);
  transition:opacity .7s cubic-bezier(.16,1,.3,1),
             transform .7s cubic-bezier(.16,1,.3,1),
             background .3s,border-color .3s;
}
.af-about-pillar.af-visible,
.af-about-who-card.af-visible,
.af-about-belief-item.af-visible{opacity:1;transform:translateY(0)}

/* RESPONSIVE */
@media(max-width:768px){
  .af-about-why-inner,.af-about-what-inner,.af-about-belief-inner{grid-template-columns:1fr;gap:48px}
  .af-about-who-cards{grid-template-columns:1fr}
  .af-about-why,.af-about-what,.af-about-who,.af-about-belief,.af-about-cta{padding-left:24px;padding-right:24px}
  .af-about-why-title{position:static}
}
</style>
<?php }

/* ── [af_about_hero] ── */
add_shortcode('af_about_hero','af_about_hero_shortcode');
function af_about_hero_shortcode(){
    ob_start();?>
    <div class="af-about-hero">
      <div class="af-about-hero-bg"></div>
      <div class="af-about-hero-overlay"></div>
      <div class="af-about-hero-content af-reveal">
        <p class="af-pod-eyebrow">Our Story</p>
        <h1 class="af-about-hero-title">About <em>An Anchored Faith</em></h1>
        <p class="af-about-hero-desc">A Christ-centred platform created to strengthen faith in Jesus Christ and His restored gospel.</p>
        <a href="#why" class="af-btn-gold">Learn More &darr;</a>
      </div>
      <div class="af-about-scroll-hint">Scroll</div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_about_why] ── */
add_shortcode('af_about_why','af_about_why_shortcode');
function af_about_why_shortcode(){
    ob_start();?>
    <div class="af-about-why" id="why">
      <div class="af-about-why-inner">
        <div class="af-reveal-left">
          <p class="af-about-why-label">Our Purpose</p>
          <h2 class="af-about-why-title">Why An<br><em>Anchored Faith</em><br>Exists</h2>
        </div>
        <div class="af-about-why-body af-reveal af-d2">
          <p>In a world filled with doubt, noise, and spiritual distraction, many sincere seekers struggle to find a place where faith is strengthened rather than questioned.</p>
          <p class="af-about-pull">"Enduring faith is built when truth is taught clearly, the Spirit is invited, and personal revelation is honoured."</p>
          <p>An Anchored Faith exists to provide a trusted space where faith can grow through testimony, evidence, and the influence of the Holy Spirit. We believe that the restored gospel of Jesus Christ has the power to answer life's deepest questions — and we want to help people find those answers.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_about_what] ── */
add_shortcode('af_about_what','af_about_what_shortcode');
function af_about_what_shortcode(){
    $pillars = [
        ['icon'=>af_icon('scriptures',40,'currentColor'),'title'=>'Living Digital Library','desc'=>'Stories, videos, transcriptions and resources that testify of modern revelation and the ongoing work of God in our day.'],
        ['icon'=>af_icon('microphone',40,'currentColor'),'title'=>'Testimonies & Evidence','desc'=>'First-hand accounts, faith experiences and evidences of the Restoration — curated and presented with care.'],
        ['icon'=>af_icon('home',40,'currentColor'),'title'=>'Home-Centred Learning','desc'=>'Content organised so individuals and families can explore, learn, and return often — without feeling overwhelmed.'],
        ['icon'=>af_icon('anchor',40,'currentColor'),'title'=>'Anchored in Christ','desc'=>'Every piece of content points back to Jesus Christ as the foundation — the anchor of our faith and our message.'],
    ];
    ob_start();?>
    <div class="af-about-what">
      <div class="af-about-what-inner">
        <div class="af-reveal-left">
          <p class="af-about-why-label" style="color:var(--af-gold)">What We Are</p>
          <h2 class="af-about-what-title">What An<br><em>Anchored Faith</em><br>Is</h2>
          <p class="af-about-what-desc">An Anchored Faith functions as a living digital library of faith-promoting content. We curate stories, videos, transcriptions and resources that testify of modern revelation, miracles, and the ongoing work of God in our day.</p>
          <p class="af-about-what-desc">Content is organised to help individuals explore, learn, and return often — without feeling overwhelmed.</p>
        </div>
        <div class="af-about-pillars af-reveal-right af-d2">
          <?php foreach($pillars as $p):?>
          <div class="af-about-pillar">
            <span class="af-about-pillar-icon"><?php echo $p['icon'];?></span>
            <div>
              <h3 class="af-about-pillar-title"><?php echo esc_html($p['title']);?></h3>
              <p class="af-about-pillar-desc"><?php echo esc_html($p['desc']);?></p>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_about_who] ── */
add_shortcode('af_about_who','af_about_who_shortcode');
function af_about_who_shortcode(){
    $cards = [
        ['icon'=>af_icon('search',40,'currentColor'),'title'=>'Seekers','desc'=>'Those searching for answers, reassurance, or spiritual strength — you are welcome here exactly as you are.'],
        ['icon'=>af_icon('heart',40,'currentColor'),'title'=>'Believers','desc'=>'Lifelong members who want to go deeper, strengthen their testimony, and share their faith with confidence.'],
        ['icon'=>af_icon('home',40,'currentColor'),'title'=>'Families','desc'=>'Parents and families looking for trusted, Christ-centred resources to bring the gospel into their homes.'],
    ];
    ob_start();?>
    <div class="af-about-who">
      <div class="af-reveal">
        <p class="af-about-why-label" style="color:var(--af-gold);justify-content:center">Who This Is For</p>
        <h2 class="af-about-who-title">This Space Is<br><em>For You</em></h2>
        <p class="af-about-who-desc">Whether you are seeking answers, reassurance, or spiritual strength — An Anchored Faith is designed to meet you where you are. This is a space to feel the Spirit, deepen understanding, and anchor belief in Jesus Christ — without pressure or distraction.</p>
      </div>
      <div class="af-about-who-cards">
        <?php foreach($cards as $i=>$c):?>
        <div class="af-about-who-card af-reveal af-d<?php echo $i+1;?>">
          <span class="af-about-who-icon"><?php echo $c['icon'];?></span>
          <h3 class="af-about-who-card-title"><?php echo esc_html($c['title']);?></h3>
          <p class="af-about-who-card-desc"><?php echo esc_html($c['desc']);?></p>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_about_belief] ── */
add_shortcode('af_about_belief','af_about_belief_shortcode');
function af_about_belief_shortcode(){
    $beliefs = [
        'Faith is not blind — it is grounded in truth, testimony, and personal revelation.',
        'Jesus Christ is the foundation of all enduring faith and the centre of our message.',
        'The restored gospel of Jesus Christ answers life\'s deepest questions.',
        'The Holy Spirit bears witness of truth — and that witness changes lives.',
    ];
    ob_start();?>
    <div class="af-about-belief">
      <div class="af-about-belief-inner">
        <div class="af-reveal-left">
          <p class="af-about-why-label">Our Beliefs</p>
          <h2 class="af-about-belief-title">What We<br><em>Believe</em></h2>
          <p class="af-section-sub" style="color:var(--af-stone);font-size:17px;margin-top:16px">Anchored in Jesus Christ, guided by the Holy Spirit, and strengthened through modern revelation — these are the convictions that shape everything we do.</p>
        </div>
        <div class="af-about-beliefs">
          <?php foreach($beliefs as $i=>$b):?>
          <div class="af-about-belief-item af-reveal af-d<?php echo min($i+1,4);?>">
            <span class="af-about-belief-num">0<?php echo $i+1;?></span>
            <p class="af-about-belief-text"><?php echo esc_html($b);?></p>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_about_cta] ── */
add_shortcode('af_about_cta','af_about_cta_shortcode');
function af_about_cta_shortcode(){
    ob_start();?>
    <div class="af-about-cta">
      <div class="af-reveal">
        <p class="af-centered-eyebrow">Ready to Explore</p>
        <h2 class="af-about-cta-title">Begin Your<br><em>Faith Journey</em></h2>
        <p class="af-about-cta-desc">Explore testimonies, evidences of the Restoration, faith-promoting stories, and resources designed to strengthen your anchor in Jesus Christ.</p>
        <div class="af-about-cta-btns">
          <a href="/posts/" class="af-about-cta-btn gold">Browse Articles &rarr;</a>
          <a href="/for-kids/" class="af-about-cta-btn ghost">Watch Faith Stories</a>
          <a href="/resources/" class="af-about-cta-btn ghost">Explore Resources</a>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ============================================================
   GENERAL CONFERENCE PAGE
   ============================================================ */

add_action('wp_head','af_conf_css',107);
function af_conf_css(){ ?>
<style id="af-conf-css">

/* ── CONFERENCE HERO ── */
.af-conf-hero{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  height:100vh;min-height:580px;overflow:hidden;
  box-sizing:border-box;
}
.af-conf-hero-bg{
  position:absolute;inset:0;
  background-image:url('/wp-content/uploads/2026/01/General_Conference.jpg');
  background-size:cover;background-position:center top;
  animation:af-kb 16s ease-in-out infinite alternate;
}
.af-conf-hero-overlay{
  position:absolute;inset:0;
  background:linear-gradient(115deg,rgba(20,16,14,.82) 0%,rgba(20,16,14,.5) 55%,rgba(20,16,14,.15) 100%);
}
.af-conf-hero-content{
  position:absolute;bottom:12%;left:9%;max-width:700px;z-index:10;
}
.af-conf-countdown{
  display:flex;gap:24px;margin-bottom:32px;flex-wrap:wrap;
}
.af-conf-count-box{
  text-align:center;
  background:rgba(184,151,90,.15);
  border:1px solid rgba(184,151,90,.35);
  padding:16px 22px;min-width:80px;
}
.af-conf-count-num{
  font-family:'Cormorant Garamond',serif;
  font-size:48px;font-weight:300;
  color:#F5C842;line-height:1;display:block;
  animation:af-num-pulse 1s ease-in-out infinite alternate;
}
@keyframes af-num-pulse{0%{opacity:1}100%{opacity:.75}}
.af-conf-count-label{
  font-family:'Jost',sans-serif;font-size:10px;
  letter-spacing:.18em;text-transform:uppercase;
  color:rgba(255,255,255,.5);font-weight:500;
  display:block;margin-top:6px;
}
.af-conf-hero-eyebrow{
  font-family:'Jost',sans-serif;font-size:13px;
  letter-spacing:.22em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;
  display:flex;align-items:center;gap:12px;margin-bottom:20px;
}
.af-conf-hero-eyebrow::before{content:'';display:block;width:32px;height:1px;background:var(--af-gold)}
.af-conf-hero-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(48px,7vw,88px);font-weight:300;
  line-height:1.03;color:#fff;margin:0 0 20px;
}
.af-conf-hero-title em{font-style:italic;color:var(--af-gold-light)}
.af-conf-hero-desc{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.72);line-height:1.78;
  font-weight:300;margin:0 0 36px;max-width:520px;
}
.af-conf-hero-btns{display:flex;gap:14px;flex-wrap:wrap}

/* ── WHAT IS CONF ── */
.af-conf-what{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-cream2);
  padding:100px 56px;box-sizing:border-box;
}
.af-conf-what-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-conf-what-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(34px,4.5vw,56px);font-weight:300;
  color:var(--af-ink);margin:0 0 24px;line-height:1.08;
}
.af-conf-what-title em{font-style:italic;color:var(--af-gold)}
.af-conf-what-desc{
  font-family:'Jost',sans-serif;font-size:17px;
  color:var(--af-stone);line-height:1.82;
  font-weight:300;margin:0 0 20px;
}
.af-conf-facts{
  display:flex;flex-direction:column;gap:2px;
}
.af-conf-fact{
  display:flex;gap:20px;align-items:flex-start;
  padding:24px 28px;
  background:#fff;border-left:3px solid transparent;
  transition:border-color .3s,transform .3s;
}
.af-conf-fact:hover{border-color:var(--af-gold);transform:translateX(4px)}
.af-conf-fact-icon{font-size:28px;flex-shrink:0;margin-top:2px}
.af-conf-fact-title{
  font-family:'Cormorant Garamond',serif;
  font-size:20px;font-weight:400;
  color:var(--af-ink);margin:0 0 4px;
}
.af-conf-fact-desc{
  font-family:'Jost',sans-serif;font-size:14px;
  color:var(--af-stone);line-height:1.6;font-weight:300;margin:0;
}

/* ── WATCH LINKS ── */
.af-conf-watch{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy);
  padding:100px 56px;box-sizing:border-box;
  text-align:center;
}
.af-conf-watch h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(34px,4.5vw,56px);font-weight:300;
  color:#fff;margin:0 0 14px;
}
.af-conf-watch h2 em{font-style:italic;color:var(--af-gold-light)}
.af-conf-watch-sub{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.55);font-weight:300;
  margin:0 0 60px;
}
.af-conf-links-grid{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:2px;background:rgba(255,255,255,.06);
  max-width:1100px;margin:0 auto 48px;
}
.af-conf-link-card{
  background:rgba(255,255,255,.03);
  padding:44px 32px;
  border-top:3px solid transparent;
  text-decoration:none;
  display:flex;flex-direction:column;align-items:center;gap:14px;
  transition:all .3s;
}
.af-conf-link-card:hover{
  background:rgba(255,255,255,.07);
  border-color:var(--af-gold);
  transform:translateY(-6px);
  text-decoration:none;
}
.af-conf-link-icon{font-size:40px}
.af-conf-link-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:rgba(255,255,255,.9);text-align:center;
}
.af-conf-link-desc{
  font-family:'Jost',sans-serif;font-size:13px;
  color:rgba(255,255,255,.4);font-weight:300;
  text-align:center;line-height:1.5;
}
.af-conf-link-arrow{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  color:var(--af-gold);font-weight:500;margin-top:8px;
}

/* ── SCHEDULE ── */
.af-conf-schedule{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-ink);
  padding:100px 56px;box-sizing:border-box;
}
.af-conf-schedule-inner{max-width:900px;margin:0 auto}
.af-conf-schedule h2{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(34px,4.5vw,56px);font-weight:300;
  color:#fff;margin:0 0 12px;
}
.af-conf-schedule h2 em{font-style:italic;color:var(--af-gold-light)}
.af-conf-schedule-sub{
  font-family:'Jost',sans-serif;font-size:17px;
  color:rgba(255,255,255,.5);font-weight:300;margin:0 0 52px;
}
.af-conf-session{
  display:grid;grid-template-columns:140px 1fr;
  gap:28px;padding:28px 0;
  border-top:1px solid rgba(255,255,255,.08);
  transition:border-color .3s;
}
.af-conf-session:hover{border-color:rgba(184,151,90,.3)}
.af-conf-session:last-child{border-bottom:1px solid rgba(255,255,255,.08)}
.af-conf-session-time{
  font-family:'Jost',sans-serif;font-size:13px;
  color:var(--af-gold);font-weight:500;
  letter-spacing:.06em;line-height:1.5;
}
.af-conf-session-day{
  font-family:'Jost',sans-serif;font-size:11px;
  letter-spacing:.14em;text-transform:uppercase;
  color:rgba(255,255,255,.3);font-weight:400;margin-bottom:4px;
}
.af-conf-session-title{
  font-family:'Cormorant Garamond',serif;
  font-size:22px;font-weight:400;
  color:rgba(255,255,255,.9);margin:0 0 6px;
}
.af-conf-session-desc{
  font-family:'Jost',sans-serif;font-size:14px;
  color:rgba(255,255,255,.4);line-height:1.6;
  font-weight:300;margin:0;
}

/* ── PREPARE ── */
.af-conf-prepare{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-gold-pale);
  padding:100px 56px;box-sizing:border-box;
}
.af-conf-prepare-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
  max-width:1200px;margin:0 auto;
}
.af-conf-prepare-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(34px,4.5vw,56px);font-weight:300;
  color:var(--af-ink);margin:0 0 24px;line-height:1.08;
}
.af-conf-prepare-title em{font-style:italic;color:var(--af-gold)}
.af-conf-tips{display:flex;flex-direction:column;gap:16px}
.af-conf-tip{
  display:flex;gap:16px;align-items:flex-start;
  padding:22px 26px;background:#fff;
  border-bottom:3px solid transparent;
  transition:border-color .3s,transform .3s,box-shadow .3s;
}
.af-conf-tip:hover{
  border-color:var(--af-gold);
  transform:translateX(6px);
  box-shadow:0 8px 32px rgba(0,0,0,.06);
}
.af-conf-tip-num{
  font-family:'Cormorant Garamond',serif;
  font-size:32px;font-weight:300;
  color:var(--af-gold);line-height:1;flex-shrink:0;
}
.af-conf-tip-text{
  font-family:'Jost',sans-serif;font-size:15px;
  color:var(--af-stone);line-height:1.7;
  font-weight:300;margin:0;padding-top:4px;
}

/* ANIMATIONS */
.af-conf-link-card{
  opacity:0;transform:translateY(24px);
  transition:opacity .6s cubic-bezier(.16,1,.3,1),
             transform .6s cubic-bezier(.16,1,.3,1),
             border-color .3s,background .3s;
}
.af-conf-link-card.af-visible{opacity:1;transform:translateY(0)}
.af-conf-session{
  opacity:0;transform:translateX(-20px);
  transition:opacity .6s cubic-bezier(.16,1,.3,1),
             transform .6s cubic-bezier(.16,1,.3,1),
             border-color .3s;
}
.af-conf-session.af-visible{opacity:1;transform:translateX(0)}

/* RESPONSIVE */
@media(max-width:768px){
  .af-conf-what-inner,.af-conf-prepare-inner{grid-template-columns:1fr;gap:48px}
  .af-conf-links-grid{grid-template-columns:1fr}
  .af-conf-session{grid-template-columns:1fr;gap:8px}
  .af-conf-hero,.af-conf-what,.af-conf-watch,.af-conf-schedule,.af-conf-prepare{padding-left:24px;padding-right:24px}
  .af-conf-countdown{gap:12px}
  .af-conf-count-box{padding:12px 16px;min-width:64px}
  .af-conf-count-num{font-size:36px}
}
</style>
<?php }

/* ── [af_conf_hero] ── */
add_shortcode('af_conf_hero','af_conf_hero_shortcode');
function af_conf_hero_shortcode(){
    // April 4 2026 09:00 AM MDT = UTC-6
    $conf_date = new DateTime('2026-04-04 09:00:00', new DateTimeZone('America/Denver'));
    $now       = new DateTime('now', new DateTimeZone('America/Denver'));
    $diff      = $now < $conf_date ? $conf_date->diff($now) : null;
    $days  = $diff ? $diff->days : 0;
    $hours = $diff ? $diff->h    : 0;
    $mins  = $diff ? $diff->i    : 0;
    ob_start();?>
    <div class="af-conf-hero">
      <div class="af-conf-hero-bg"></div>
      <div class="af-conf-hero-overlay"></div>
      <div class="af-conf-hero-content af-reveal">
        <p class="af-conf-hero-eyebrow">April 4–5, 2026</p>
        <h1 class="af-conf-hero-title">General<br><em>Conference</em></h1>
        <p class="af-conf-hero-desc">Experience peace and hope through Jesus Christ. Join believers worldwide as Church leaders share inspired messages centred on the Saviour.</p>
        <?php if($days > 0):?>
        <div class="af-conf-countdown" id="af-conf-countdown">
          <div class="af-conf-count-box"><span class="af-conf-count-num" id="af-days"><?php echo $days;?></span><span class="af-conf-count-label">Days</span></div>
          <div class="af-conf-count-box"><span class="af-conf-count-num" id="af-hours"><?php echo $hours;?></span><span class="af-conf-count-label">Hours</span></div>
          <div class="af-conf-count-box"><span class="af-conf-count-num" id="af-mins"><?php echo $mins;?></span><span class="af-conf-count-label">Minutes</span></div>
        </div>
        <?php endif;?>
        <div class="af-conf-hero-btns">
          <a href="https://www.churchofjesuschrist.org/feature/general-conference?lang=eng" target="_blank" class="af-btn-gold">Watch Live →</a>
          <a href="#schedule" class="af-btn-outline">View Schedule</a>
        </div>
      </div>
    </div>
    <script>
    (function(){
      var target = new Date('2026-04-04T09:00:00-06:00').getTime();
      function update(){
        var now  = Date.now();
        var diff = target - now;
        if(diff <= 0){ return; }
        var d = Math.floor(diff/86400000);
        var h = Math.floor((diff%86400000)/3600000);
        var m = Math.floor((diff%3600000)/60000);
        var dEl=document.getElementById('af-days');
        var hEl=document.getElementById('af-hours');
        var mEl=document.getElementById('af-mins');
        if(dEl) dEl.textContent=d;
        if(hEl) hEl.textContent=h;
        if(mEl) mEl.textContent=m;
      }
      update();
      setInterval(update,30000);
    })();
    </script>
    <?php return ob_get_clean();
}

/* ── [af_conf_what] ── */
add_shortcode('af_conf_what','af_conf_what_shortcode');
function af_conf_what_shortcode(){
    $facts=[
        ['icon'=>af_icon('globe',40,'currentColor'),'title'=>'A Global Gathering','desc'=>'Broadcast live in 70+ languages and translated into more than 100 languages — truly for everyone, everywhere.'],
        ['icon'=>af_icon('tv_screen',40,'currentColor'),'title'=>'Five Sessions','desc'=>'Five two-hour sessions over two days — watch live or on your own schedule, anytime after.'],
        ['icon'=>af_icon('star',40,'currentColor'),'title'=>'Centred on Christ','desc'=>'Prophets, apostles, and Church leaders share messages focused on Jesus Christ and His gospel.'],
        ['icon'=>af_icon('home',40,'currentColor'),'title'=>'All Are Welcome','desc'=>'Everyone of all faiths, beliefs, and backgrounds is invited to watch, listen, and participate.'],
    ];
    ob_start();?>
    <div class="af-conf-what">
      <div class="af-conf-what-inner">
        <div class="af-reveal-left">
          <p class="af-about-why-label">About Conference</p>
          <h2 class="af-conf-what-title">What Is General<br><em>Conference?</em></h2>
          <p class="af-conf-what-desc">General conference is the worldwide gathering of The Church of Jesus Christ of Latter-day Saints. Twice a year, Church leaders from around the world share messages focused on Jesus Christ and His gospel.</p>
          <p class="af-conf-what-desc">Participating helps us find peace, hope, and joy through Jesus Christ — and learn how to strengthen our families as we follow His teachings.</p>
        </div>
        <div class="af-conf-facts af-reveal-right af-d2">
          <?php foreach($facts as $f):?>
          <div class="af-conf-fact">
            <span class="af-conf-fact-icon"><?php echo $f['icon'];?></span>
            <div>
              <h3 class="af-conf-fact-title"><?php echo esc_html($f['title']);?></h3>
              <p class="af-conf-fact-desc"><?php echo esc_html($f['desc']);?></p>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_conf_watch] ── */
add_shortcode('af_conf_watch','af_conf_watch_shortcode');
function af_conf_watch_shortcode(){
    $links=[
        ['icon'=>af_icon('play',40,'currentColor'),'title'=>'Watch Conference','desc'=>'Stream all sessions live on the Church website','url'=>'https://www.churchofjesuschrist.org/feature/general-conference?lang=eng'],
        ['icon'=>af_icon('phone',40,'currentColor'),'title'=>'Gospel Library App','desc'=>'Download the free app for iOS and Android','url'=>'https://www.churchofjesuschrist.org/learn/ways-to-watch-general-conference?lang=eng'],
        ['icon'=>af_icon('tv_screen',40,'currentColor'),'title'=>'BYUtv','desc'=>'Watch on BYUtv — available on most cable and streaming providers','url'=>'https://www.byutv.org/generalconference'],
        ['icon'=>af_icon('newspaper',40,'currentColor'),'title'=>'Conference News','desc'=>'Latest news and updates from the Newsroom','url'=>'https://newsroom.churchofjesuschrist.org'],
        ['icon'=>af_icon('clock',40,'currentColor'),'title'=>'Past Conferences','desc'=>'Browse talks from every conference ever held','url'=>'https://www.churchofjesuschrist.org/study/general-conference?lang=eng'],
        ['icon'=>af_icon('family',40,'currentColor'),'title'=>'Family Resources','desc'=>'Activities and resources for children and youth','url'=>'https://www.churchofjesuschrist.org/feature/general-conference/activities-for-children-and-youth?lang=eng'],
    ];
    ob_start();?>
    <div class="af-conf-watch">
      <div class="af-reveal">
        <p class="af-eyebrow" style="justify-content:center;color:var(--af-gold)">April 4–5, 2026</p>
        <h2>Where to <em>Watch & Learn</em></h2>
        <p class="af-conf-watch-sub">All sessions are free. Watch live or on your own schedule from anywhere in the world.</p>
      </div>
      <div class="af-conf-links-grid">
        <?php foreach($links as $i=>$l):?>
        <a href="<?php echo esc_url($l['url']);?>" target="_blank" class="af-conf-link-card af-reveal af-d<?php echo min($i%3+1,3);?>">
          <span class="af-conf-link-icon"><?php echo $l['icon'];?></span>
          <span class="af-conf-link-title"><?php echo esc_html($l['title']);?></span>
          <span class="af-conf-link-desc"><?php echo esc_html($l['desc']);?></span>
          <span class="af-conf-link-arrow">Visit →</span>
        </a>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_conf_schedule] ── */
add_shortcode('af_conf_schedule','af_conf_schedule_shortcode');
function af_conf_schedule_shortcode(){
    $sessions=[
        ['day'=>'Saturday, April 4','time'=>'10:00 AM MDT','title'=>'Morning Session','desc'=>'Opening session with messages from General Authorities and General Officers of the Church.'],
        ['day'=>'Saturday, April 4','time'=>'2:00 PM MDT','title'=>'Afternoon Session','desc'=>'Continued messages from Church leaders — sustained officers announced.'],
        ['day'=>'Saturday, April 4','time'=>'6:00 PM MDT','title'=>'Priesthood Session','desc'=>'Messages addressed to all holders of the Aaronic and Melchizedek Priesthood.'],
        ['day'=>'Sunday, April 5','time'=>'10:00 AM MDT','title'=>'Morning Session','desc'=>'Sunday morning messages from apostles and the First Presidency.'],
        ['day'=>'Sunday, April 5','time'=>'2:00 PM MDT','title'=>'Afternoon Session','desc'=>'Closing session — final messages and the concluding hymn and prayer.'],
    ];
    ob_start();?>
    <div class="af-conf-schedule" id="schedule">
      <div class="af-conf-schedule-inner">
        <div class="af-reveal">
          <p class="af-eyebrow" style="color:var(--af-gold)">Sessions</p>
          <h2>Conference <em>Schedule</em></h2>
          <p class="af-conf-schedule-sub">All times Mountain Daylight Time (MDT / UTC−6). Convert to your local time zone.</p>
        </div>
        <?php foreach($sessions as $s):?>
        <div class="af-conf-session">
          <div>
            <p class="af-conf-session-day"><?php echo esc_html($s['day']);?></p>
            <p class="af-conf-session-time"><?php echo esc_html($s['time']);?></p>
          </div>
          <div>
            <h3 class="af-conf-session-title"><?php echo esc_html($s['title']);?></h3>
            <p class="af-conf-session-desc"><?php echo esc_html($s['desc']);?></p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── [af_conf_prepare] ── */
add_shortcode('af_conf_prepare','af_conf_prepare_shortcode');
function af_conf_prepare_shortcode(){
    $tips=[
        'Pray for guidance about what the Lord wants you to personally hear and receive.',
        'Write down questions you want answered — then listen for answers during sessions.',
        'Keep a notebook or journal to record impressions and insights as they come.',
        'Involve your family — watch together and discuss what you learned afterwards.',
        'Look up scriptures and references quoted by the speakers to deepen your study.',
        'Apply one message — choose one talk and commit to act on its invitation this week.',
    ];
    ob_start();?>
    <div class="af-conf-prepare">
      <div class="af-conf-prepare-inner">
        <div class="af-reveal-left">
          <p class="af-about-why-label">Preparation</p>
          <h2 class="af-conf-prepare-title">How to Prepare for<br><em>Conference</em></h2>
          <p class="af-section-sub" style="color:var(--af-stone);font-size:17px;margin-top:16px">Those who prepare spiritually get far more from conference. Here are six practical ways to come ready to receive.</p>
          <a href="https://www.churchofjesuschrist.org/study/manual/how-to-prepare-to-participate-in-general-conference/how-to-prepare-to-participate-in-general-conference?lang=eng" target="_blank" class="af-btn-gold" style="margin-top:32px;display:inline-flex">More Preparation Ideas →</a>
        </div>
        <div class="af-conf-tips">
          <?php foreach($tips as $i=>$t):?>
          <div class="af-conf-tip af-reveal af-d<?php echo min($i%3+1,3);?>">
            <span class="af-conf-tip-num">0<?php echo $i+1;?></span>
            <p class="af-conf-tip-text"><?php echo esc_html($t);?></p>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

/* ── ANNOUNCEMENT BAR CSS ── */
add_action('wp_head','af_announcement_css',108);
function af_announcement_css(){ ?>
<style id="af-announcement">

.af-announcement-bar{
  position:relative;left:50%;right:50%;
  margin-left:-50vw!important;margin-right:-50vw!important;
  width:100vw!important;max-width:100vw!important;
  background:var(--af-navy);
  border-bottom:2px solid var(--af-gold);
  padding:0;box-sizing:border-box;
  z-index:10;
}
.af-announcement-inner{
  display:flex;align-items:center;justify-content:center;
  gap:14px;padding:13px 32px;flex-wrap:wrap;
}
.af-announcement-badge{
  background:var(--af-gold);
  color:#fff;
  font-family:'Jost',sans-serif;
  font-size:10px;font-weight:700;
  letter-spacing:.14em;text-transform:uppercase;
  padding:4px 10px;
  animation:af-badge-pulse 2s ease-in-out infinite;
  flex-shrink:0;
}
@keyframes af-badge-pulse{
  0%,100%{background:var(--af-gold)}
  50%{background:#D4972A}
}
.af-announcement-icon{
  font-size:16px;flex-shrink:0;
  animation:af-icon-shake 3s ease-in-out infinite;
}
@keyframes af-icon-shake{
  0%,100%{transform:rotate(0deg)}
  10%{transform:rotate(-12deg)}
  20%{transform:rotate(12deg)}
  30%{transform:rotate(-8deg)}
  40%{transform:rotate(8deg)}
  50%{transform:rotate(0deg)}
}
.af-announcement-text{
  font-family:'Jost',sans-serif;
  font-size:14px;font-weight:400;
  color:rgba(255,255,255,.9);
  letter-spacing:.04em;
}
.af-announcement-text strong{
  color:var(--af-gold);font-weight:600;
}
.af-announcement-link{
  font-family:'Jost',sans-serif;
  font-size:12px;font-weight:600;
  letter-spacing:.12em;text-transform:uppercase;
  color:var(--af-gold);
  text-decoration:none;
  border:1px solid rgba(184,151,90,.4);
  padding:6px 16px;
  flex-shrink:0;
  transition:all .25s;
  white-space:nowrap;
}
.af-announcement-link:hover{
  background:var(--af-gold);
  color:#fff;
  text-decoration:none;
  border-color:var(--af-gold);
}

/* Divider between announcement and marquee */
.af-announcement-bar + .af-marquee-wrap{
  border-top:none;
}

@media(max-width:600px){
  .af-announcement-text{font-size:12px}
  .af-announcement-inner{gap:8px;padding:10px 16px}
}
</style>
<?php }

/* ── NAV MENU STYLING ── */
add_action('wp_head','af_nav_css',109);
function af_nav_css(){ ?>
<style id="af-nav-css">

/* ── MAIN NAVIGATION ── */
.main-navigation,
.site-header,
#masthead,
.kadence-sticky-header,
header.site-header,
.wp-block-template-part,
.header-wrapper {
  background: var(--af-ink) !important;
  border-bottom: 1px solid rgba(184,151,90,.2) !important;
}

/* Site title / logo */
.site-title a,
.site-title,
.custom-logo-link,
.header-site-title a {
  font-family: 'Cormorant Garamond', serif !important;
  font-size: 22px !important;
  font-weight: 300 !important;
  letter-spacing: .05em !important;
  color: #fff !important;
  text-decoration: none !important;
}
.site-title a:hover { color: var(--af-gold) !important; }

/* Nav links */
.main-navigation a,
.main-navigation ul li a,
nav.main-navigation ul li a,
#site-navigation a,
.primary-menu a,
.nav-primary a,
header nav a,
.header-navigation a {
  font-family: 'Jost', sans-serif !important;
  font-size: 12px !important;
  font-weight: 500 !important;
  letter-spacing: .1em !important;
  text-transform: uppercase !important;
  color: rgba(255,255,255,.75) !important;
  text-decoration: none !important;
  padding: 8px 16px !important;
  transition: color .2s !important;
  position: relative !important;
}

/* Nav link hover */
.main-navigation a:hover,
.main-navigation ul li a:hover,
#site-navigation a:hover,
.primary-menu a:hover,
header nav a:hover {
  color: var(--af-gold) !important;
}

/* Active / current page */
.main-navigation .current-menu-item > a,
.main-navigation .current_page_item > a,
.primary-menu .current-menu-item > a {
  color: var(--af-gold) !important;
}

/* Gold underline on hover */
.main-navigation ul li a::after,
#site-navigation ul li a::after {
  content: '' !important;
  position: absolute !important;
  bottom: 0 !important;
  left: 16px !important;
  width: 0 !important;
  height: 1px !important;
  background: var(--af-gold) !important;
  transition: width .3s ease !important;
}
.main-navigation ul li a:hover::after,
.main-navigation .current-menu-item > a::after {
  width: calc(100% - 32px) !important;
}

/* Dropdown menus */
.main-navigation ul ul,
.main-navigation ul .sub-menu {
  background: var(--af-ink) !important;
  border: 1px solid rgba(184,151,90,.2) !important;
  border-top: 2px solid var(--af-gold) !important;
  box-shadow: 0 8px 32px rgba(0,0,0,.3) !important;
}
.main-navigation ul ul a,
.main-navigation ul .sub-menu a {
  color: rgba(255,255,255,.7) !important;
  border-bottom: 1px solid rgba(255,255,255,.06) !important;
}
.main-navigation ul ul a:hover,
.main-navigation ul .sub-menu a:hover {
  color: var(--af-gold) !important;
  background: rgba(184,151,90,.06) !important;
}

/* Mobile menu toggle button */
.menu-toggle,
button.menu-toggle,
.kadence-mobile-nav-toggle,
#mobile-menu-toggle {
  background: transparent !important;
  border: 1px solid rgba(184,151,90,.4) !important;
  color: rgba(255,255,255,.85) !important;
  padding: 8px 14px !important;
  transition: all .2s !important;
}
.menu-toggle:hover,
button.menu-toggle:hover {
  border-color: var(--af-gold) !important;
  color: var(--af-gold) !important;
}

/* Mobile nav open */
.main-navigation.toggled ul,
.main-navigation.toggled .nav-menu {
  background: var(--af-ink) !important;
  border-top: 1px solid rgba(184,151,90,.2) !important;
}

/* Elementor nav widget */
.elementor-nav-menu a,
.elementor-widget-nav-menu a {
  font-family: 'Jost', sans-serif !important;
  font-size: 12px !important;
  font-weight: 500 !important;
  letter-spacing: .1em !important;
  text-transform: uppercase !important;
  color: rgba(255,255,255,.75) !important;
  transition: color .2s !important;
}
.elementor-nav-menu a:hover,
.elementor-widget-nav-menu a:hover {
  color: var(--af-gold) !important;
}

/* Kadence specific */
.kadence-header-row,
.kadence-header-top,
.kadence-header-main,
.kadence-header-bottom {
  background: var(--af-ink) !important;
}
.kadence-header-main-inner,
.header-main-inner {
  border-bottom: none !important;
}
</style>
<?php }

/* ── FOOTER REDESIGN ── */
add_action('wp_head','af_footer_redesign_css',110);
function af_footer_redesign_css(){ ?>
<style id="af-footer-redesign">

/* Hide the default WordPress/Kadence footer content */
.site-footer .site-info,
.site-footer .footer-wrap > *:not(.af-footer-custom),
footer.site-footer > *:not(.af-footer-custom),
#colophon > *:not(.af-footer-custom) {
  display: none !important;
}

/* Our custom footer */
.af-footer-custom {
  background: var(--af-ink);
  width: 100%;
  font-family: 'Jost', sans-serif;
}

/* Top section — 4 columns */
.af-footer-top {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 56px;
  padding: 72px 56px 56px;
  border-bottom: 1px solid rgba(255,255,255,.07);
  max-width: 100%;
  box-sizing: border-box;
}

/* Brand column */
.af-footer-brand-logo {
  font-family: 'Cormorant Garamond', serif;
  font-size: 24px;
  font-weight: 300;
  color: #fff;
  margin: 0 0 14px;
  letter-spacing: .04em;
  display: flex;
  align-items: center;
  gap: 10px;
}
.af-footer-brand-logo span { color: var(--af-gold); }
.af-footer-brand-desc {
  font-size: 14px;
  color: rgba(255,255,255,.45);
  line-height: 1.75;
  font-weight: 300;
  max-width: 260px;
  margin: 0 0 28px;
}

/* Social icons */
.af-footer-social {
  display: flex;
  gap: 10px;
}
.af-footer-social a {
  width: 40px;
  height: 40px;
  border: 1px solid rgba(255,255,255,.12);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,.5) !important;
  text-decoration: none !important;
  font-size: 16px;
  transition: all .3s;
  font-weight: 400;
}
.af-footer-social a:hover {
  border-color: var(--af-gold) !important;
  color: var(--af-gold) !important;
  background: rgba(184,151,90,.08);
}

/* Link columns */
.af-footer-col h5 {
  font-size: 11px;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: var(--af-gold);
  font-weight: 600;
  margin: 0 0 20px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(184,151,90,.25);
}
.af-footer-col ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.af-footer-col ul li {
  margin-bottom: 13px;
}
.af-footer-col ul li a {
  font-size: 15px;
  color: rgba(255,255,255,.8) !important;
  text-decoration: none !important;
  font-weight: 300;
  transition: color .2s, padding-left .2s;
  display: flex;
  align-items: center;
  gap: 8px;
}
.af-footer-col ul li a::before {
  content: '→';
  font-size: 12px;
  color: var(--af-gold);
  flex-shrink: 0;
  transition: transform .2s;
  font-style: normal;
}
.af-footer-col ul li a:hover {
  color: var(--af-gold-light) !important;
  padding-left: 4px;
}
.af-footer-col ul li a:hover::before {
  transform: translateX(3px);
}

/* Bottom bar */
.af-footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 22px 56px;
  flex-wrap: wrap;
  gap: 12px;
}
.af-footer-copy {
  font-size: 13px;
  color: rgba(255,255,255,.25);
  font-weight: 300;
}
.af-footer-copy a {
  color: rgba(255,255,255,.35) !important;
  text-decoration: none !important;
  transition: color .2s;
}
.af-footer-copy a:hover { color: var(--af-gold) !important; }
.af-footer-made {
  font-size: 12px;
  color: rgba(255,255,255,.2);
  font-weight: 300;
}
.af-footer-made a {
  color: rgba(184,151,90,.5) !important;
  text-decoration: none !important;
  transition: color .2s;
}
.af-footer-made a:hover { color: var(--af-gold) !important; }

/* Responsive */
@media(max-width:900px){
  .af-footer-top { grid-template-columns: 1fr 1fr; gap: 40px; padding: 56px 24px 40px; }
  .af-footer-bottom { padding: 20px 24px; }
}
@media(max-width:560px){
  .af-footer-top { grid-template-columns: 1fr; }
}
</style>
<?php }

/* ── [af_footer] shortcode ── */
add_shortcode('af_footer','af_footer_shortcode');
function af_footer_shortcode(){
    ob_start();?>
    <div class="af-footer-custom">
      <div class="af-footer-top">

        <!-- Brand -->
        <div>
          <p class="af-footer-brand-logo">An <span>Anchored</span> Faith</p>
          <p class="af-footer-brand-desc">A Christ-centred platform anchoring hearts and minds in Jesus Christ through testimony, evidence, and lived experience.</p>
          <div class="af-footer-social">
            <a href="https://www.facebook.com/profile.php?id=61585676409004" target="_blank" title="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
            </a>
            <a href="https://www.instagram.com/an_anchored_faith" target="_blank" title="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="https://youtube.com/@ananchoredfaith?si=qjHU4hT-lvgE7KL9" target="_blank" title="YouTube">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
            </a>
            <a href="https://x.com/BenjamimJo96277" target="_blank" title="X / Twitter">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="https://www.tiktok.com/@an.anchored.faith" target="_blank" title="TikTok">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.16 8.16 0 004.77 1.52V6.75a4.85 4.85 0 01-1-.06z"/></svg>
            </a>
          </div>
        </div>

        <!-- Explore -->
        <div class="af-footer-col">
          <h5>Explore</h5>
          <ul>
            <li><a href="/for-kids/">For Kids</a></li>
            <li><a href="/posts/">Posts</a></li>
            <li><a href="/general-conference/">General Conference</a></li>
            <li><a href="/podcasts/">Podcasts</a></li>
          </ul>
        </div>

        <!-- Resources -->
        <div class="af-footer-col">
          <h5>Listen & Watch</h5>
          <ul>
            <li><a href="/podcasts/">Our Podcast</a></li>
            <li><a href="https://youtube.com/@ananchoredfaith" target="_blank">YouTube Channel</a></li>
            <li><a href="https://www.churchofjesuschrist.org/study/general-conference?lang=eng" target="_blank">Past Conferences</a></li>
            <li><a href="https://www.byutv.org" target="_blank">BYUtv</a></li>
          </ul>
        </div>

        <!-- About -->
        <div class="af-footer-col">
          <h5>About</h5>
          <ul>
            <li><a href="/about-us-2/">About Us</a></li>
            <li><a href="/contact-us/">Contact Us</a></li>
            <li><a href="/privacy-policy/">Privacy Policy</a></li>
          </ul>
        </div>

      </div>

      <!-- Bottom bar -->
      <div class="af-footer-bottom">
        <p class="af-footer-copy">© 2026 An Anchored Faith. All rights reserved. | <a href="/privacy-policy/">Privacy Policy</a></p>
        
      </div>
    </div>
    <?php return ob_get_clean();
}

/* Also inject the footer automatically into wp_footer so it shows without a shortcode */
add_action('wp_footer','af_auto_footer', 5);
function af_auto_footer(){
    echo do_shortcode('[af_footer]');
}

/* ── GLOBAL TEXT CONTRAST BOOST ── */
add_action('wp_head','af_contrast_boost',201);
function af_contrast_boost(){ ?>
<style id="af-contrast-boost">

/* ── ALL BODY / DESC TEXT ── */
.af-slide-desc,
.af-kids-hero-v2-desc,
.af-kids-hero-desc,
.af-pod-hero-desc,
.af-pod-about-desc,
.af-kids-parents-desc,
.af-kids-why-v2-desc,
.af-resources-desc,
.af-section-sub,
.af-kids-section-sub,
.af-kids-featured-desc,
.af-pod-episodes-header p,
.af-pod-where p,
.af-centered-desc,
.af-about-hero-desc,
.af-about-why-desc,
.af-about-what-desc,
.af-conf-what-desc,
.af-conf-hero-desc,
.af-conf-schedule-sub,
.af-kids-why-v2-desc { 
  color: rgba(255,255,255,.88) !important; 
}

/* Light background sections — dark text */
.af-about-why .af-about-why-body p,
.af-about-belief-text,
.af-conf-fact-desc,
.af-conf-tip-text,
.af-card-desc,
.af-activity-desc,
.af-kids-pillar-desc,
.af-age-card-desc,
.af-kres-desc,
.af-kids-card-desc,
.af-pod-ep-desc,
.af-about-who-card-desc,
.af-about-pillar-desc { 
  color: #4A4035 !important; 
}

/* Stone/muted text on cream backgrounds */
.af-section-sub,
.af-kids-ages-header p,
.af-kids-resources-v2-header p,
.af-pod-about-desc,
.af-about-what-desc,
.af-conf-what-desc,
.af-kids-parents-desc,
.af-kids-why-v2-desc,
.af-about-why-desc,
.af-conf-hero-desc + p,
.af-conf-schedule-sub,
.af-pod-where p,
.af-pod-episodes-header p { 
  color: #5A5048 !important; 
}

/* White sections — max readable */
.af-videos .af-section-sub { color: rgba(255,255,255,.75) !important; }
.af-centered-desc          { color: rgba(255,255,255,.75) !important; }
.af-pod-hero-desc          { color: rgba(255,255,255,.82) !important; }
.af-conf-hero-desc         { color: rgba(255,255,255,.85) !important; }
.af-kids-hero-v2-desc      { color: rgba(255,255,255,.85) !important; }
.af-about-hero-desc        { color: rgba(255,255,255,.85) !important; }

/* Card descriptions — clearly readable */
.af-card-desc              { color: #3D3428 !important; font-size:15px !important; }
.af-kres-desc              { color: #3D3428 !important; font-size:15px !important; }
.af-age-card-desc          { color: #3D3428 !important; font-size:15px !important; }
.af-kids-pillar-desc       { color: #3D3428 !important; font-size:15px !important; }
.af-activity-desc          { color: #3D3428 !important; font-size:15px !important; }
.af-kids-featured-desc     { color: #5A5048 !important; font-size:16px !important; }
.af-kids-card-desc         { color: rgba(255,255,255,.75) !important; }

/* Dark section text — bright enough */
.af-pod-ep-desc            { color: rgba(255,255,255,.7) !important; }
.af-about-pillar-desc      { color: rgba(255,255,255,.7) !important; }
.af-about-who-card-desc    { color: rgba(255,255,255,.7) !important; }
.af-conf-session-desc      { color: rgba(255,255,255,.7) !important; }
.af-pod-plat-sub           { color: rgba(255,255,255,.6) !important; }
.af-resources-desc         { color: rgba(255,255,255,.75) !important; }

/* Fact / tip text on light backgrounds */
.af-conf-fact-desc         { color: #4A4035 !important; font-size:15px !important; }
.af-conf-tip-text          { color: #4A4035 !important; font-size:16px !important; }
.af-about-belief-text      { color: #4A4035 !important; font-size:16px !important; }

/* Scripture & quote text */
.af-scripture blockquote   { color: rgba(255,255,255,.95) !important; }
.af-kids-verse-text        { color: #2C2416 !important; }
.af-kids-verse-ref         { color: #7C6848 !important; }
.af-kids-tip-quote         { color: rgba(255,255,255,.92) !important; }
.af-pod-quote              { color: rgba(255,255,255,.92) !important; }
.af-about-pull             { color: #2C2416 !important; }

/* Footer description */
.af-footer-brand-desc      { color: rgba(255,255,255,.65) !important; }
.af-footer-copy            { color: rgba(255,255,255,.5) !important; }

/* Announcement bar */
.af-announcement-text      { color: rgba(255,255,255,.95) !important; font-size:15px !important; }

/* Nav links brighter */
.af-conf-session-time      { color: var(--af-gold) !important; font-size:15px !important; }
.af-conf-session-day       { color: rgba(255,255,255,.6) !important; }
.af-pod-stat-label         { color: rgba(255,255,255,.6) !important; font-size:14px !important; }
.af-video-channel          { color: var(--af-gold) !important; font-size:12px !important; }
.af-pod-video-channel      { color: var(--af-gold) !important; }

/* Eyebrows clearer */
.af-eyebrow,
.af-pod-eyebrow,
.af-about-why-label,
.af-kids-verse-label       { color: var(--af-gold) !important; font-size:13px !important; }

</style>
<?php }

/* ── CONFERENCE WATCH CARDS FIX ── */
add_action('wp_head','af_conf_watch_fix',202);
function af_conf_watch_fix(){ ?>
<style id="af-conf-watch-fix">

/* Watch & Learn card text — fully visible */
.af-conf-link-title {
  color: #fff !important;
  font-size: 24px !important;
}
.af-conf-link-desc {
  color: rgba(255,255,255,.82) !important;
  font-size: 15px !important;
  line-height: 1.65 !important;
}
.af-conf-link-arrow {
  color: var(--af-gold) !important;
  font-size: 13px !important;
}
.af-conf-link-icon {
  font-size: 48px !important;
}

/* Card background brighter so text pops */
.af-conf-link-card {
  background: rgba(255,255,255,.07) !important;
  border: 1px solid rgba(255,255,255,.15) !important;
}
.af-conf-link-card:hover {
  background: rgba(255,255,255,.13) !important;
  border-color: var(--af-gold) !important;
}

/* Watch section subtitle */
.af-conf-watch-sub {
  color: rgba(255,255,255,.82) !important;
  font-size: 17px !important;
}

/* Also fix episode descriptions on the podcast page */
.af-pod-ep-title  { color: #fff !important; font-size: 24px !important; }
.af-pod-ep-desc   { color: rgba(255,255,255,.82) !important; font-size: 15px !important; }
.af-pod-ep-num    { color: rgba(255,255,255,.3) !important; }
.af-pod-ep-type.audio { color: var(--af-gold) !important; }
.af-pod-ep-type.video { color: #93C5FD !important; }

/* Conference session text */
.af-conf-session-title { color: #fff !important; font-size: 24px !important; }
.af-conf-session-desc  { color: rgba(255,255,255,.82) !important; font-size: 15px !important; }
.af-conf-session-time  { color: var(--af-gold) !important; font-size: 16px !important; }
.af-conf-session-day   { color: rgba(255,255,255,.65) !important; font-size: 12px !important; }

/* Platform cards on podcast page */
.af-pod-plat-name { color: #fff !important; font-size: 15px !important; }
.af-pod-plat-sub  { color: rgba(255,255,255,.7) !important; font-size: 13px !important; }

</style>
<?php }

/* ============================================================
   LDS SVG ICON LIBRARY
   Usage: echo af_icon('scriptures'); 
   ============================================================ */
function af_icon($name, $size=36, $color='currentColor'){
  $s = $size; $c = $color;
  $icons = [

    'scriptures' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="6" y="2" width="26" height="34" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <rect x="4" y="4" width="26" height="34" rx="2" stroke="'.$c.'" stroke-width="1.8" fill="none"/>
      <line x1="10" y1="14" x2="26" y2="14" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="10" y1="20" x2="26" y2="20" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="10" y1="26" x2="20" y2="26" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
    </svg>',

    'angel_moroni' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="8" r="5" stroke="'.$c.'" stroke-width="1.8"/>
      <rect x="16" y="13" width="8" height="12" rx="1" stroke="'.$c.'" stroke-width="1.6"/>
      <path d="M24 16 L34 12" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <path d="M24 20 L34 24" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <path d="M16 16 L6 12" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <path d="M16 20 L6 24" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <rect x="14" y="25" width="12" height="12" rx="1" stroke="'.$c.'" stroke-width="1.6"/>
      <path d="M17 25 L17 22 L23 22 L23 25" stroke="'.$c.'" stroke-width="1.4"/>
      <circle cx="20" cy="3" r="1.5" fill="'.$c.'"/>
    </svg>',

    'temple' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="6" y="22" width="28" height="16" rx="1" stroke="'.$c.'" stroke-width="1.8"/>
      <polygon points="20,6 8,22 32,22" stroke="'.$c.'" stroke-width="1.8" stroke-linejoin="round"/>
      <rect x="16" y="28" width="5" height="8" rx="1" stroke="'.$c.'" stroke-width="1.4"/>
      <rect x="23" y="28" width="5" height="8" rx="1" stroke="'.$c.'" stroke-width="1.4"/>
      <line x1="20" y1="6" x2="20" y2="2" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <circle cx="20" cy="1.5" r="1.5" fill="'.$c.'"/>
      <line x1="9" y1="30" x2="13" y2="30" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
    </svg>',

    'family' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="8" r="5" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M10 28 Q20 18 30 28" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <circle cx="8" cy="16" r="4" stroke="'.$c.'" stroke-width="1.5"/>
      <circle cx="32" cy="16" r="4" stroke="'.$c.'" stroke-width="1.5"/>
      <path d="M2 30 Q8 22 14 30" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round"/>
      <path d="M26 30 Q32 22 38 30" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round"/>
      <line x1="8" y1="32" x2="32" y2="32" stroke="'.$c.'" stroke-width="1" opacity=".4"/>
    </svg>',

    'anchor' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="10" r="5" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="20" y1="15" x2="20" y2="36" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <line x1="10" y1="26" x2="30" y2="26" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <path d="M10 26 Q6 32 10 36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <path d="M30 26 Q34 32 30 36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <line x1="15" y1="8" x2="25" y2="8" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
    </svg>',

    'testimony' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 4 C14 10 8 18 10 26 C12 32 16 36 20 37 C24 36 28 32 30 26 C32 18 26 10 20 4Z" stroke="'.$c.'" stroke-width="1.8" stroke-linejoin="round"/>
      <path d="M20 16 C17 20 16 24 17 28 C18 31 19 32 20 32 C21 32 22 31 23 28 C24 24 23 20 20 16Z" fill="'.$c.'" opacity=".35"/>
    </svg>',

    'prayer' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 2 L12 12 L12 28 C12 32 16 36 20 38 C24 36 28 32 28 28 L28 12 Z" stroke="'.$c.'" stroke-width="1.8" stroke-linejoin="round" fill="none"/>
      <line x1="20" y1="12" x2="20" y2="38" stroke="'.$c.'" stroke-width="1.2" opacity=".4"/>
      <line x1="14" y1="18" x2="26" y2="18" stroke="'.$c.'" stroke-width="1" opacity=".3"/>
    </svg>',

    'microphone' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="14" y="4" width="12" height="20" rx="6" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M8 22 Q8 34 20 34 Q32 34 32 22" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" fill="none"/>
      <line x1="20" y1="34" x2="20" y2="39" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <line x1="14" y1="39" x2="26" y2="39" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
    </svg>',

    'baptism' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="10" r="5" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M14 16 L14 24" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <path d="M26 16 L26 24" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <path d="M14 22 L20 26 L26 22" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <path d="M4 32 Q12 26 20 32 Q28 38 36 32" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" fill="none"/>
      <path d="M4 36 Q12 30 20 36 Q28 42 36 36" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round" fill="none" opacity=".5"/>
    </svg>',

    'primary' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="14" cy="10" r="5" stroke="'.$c.'" stroke-width="1.6"/>
      <circle cx="26" cy="10" r="5" stroke="'.$c.'" stroke-width="1.6"/>
      <path d="M6 28 Q14 20 22 28" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <path d="M18 28 Q26 20 34 28" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <line x1="14" y1="32" x2="14" y2="38" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="26" y1="32" x2="26" y2="38" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
    </svg>',

    'book_of_mormon' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="4" width="28" height="34" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <rect x="8" y="2" width="28" height="34" rx="2" stroke="'.$c.'" stroke-width="1.8" fill="none"/>
      <line x1="14" y1="14" x2="30" y2="14" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="14" y1="20" x2="30" y2="20" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="14" y1="26" x2="22" y2="26" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <path d="M20 8 L22 11 L25 8 L22 5 Z" fill="'.$c.'" opacity=".6"/>
    </svg>',

    'globe' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="20" r="16" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M20 4 Q14 12 14 20 Q14 28 20 36" stroke="'.$c.'" stroke-width="1.4" fill="none"/>
      <path d="M20 4 Q26 12 26 20 Q26 28 20 36" stroke="'.$c.'" stroke-width="1.4" fill="none"/>
      <line x1="4" y1="20" x2="36" y2="20" stroke="'.$c.'" stroke-width="1.4"/>
      <path d="M6 13 Q20 16 34 13" stroke="'.$c.'" stroke-width="1" fill="none"/>
      <path d="M6 27 Q20 24 34 27" stroke="'.$c.'" stroke-width="1" fill="none"/>
    </svg>',

    'tv_screen' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="6" width="32" height="22" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <polygon points="16,12 16,22 26,17" fill="'.$c.'" opacity=".6"/>
      <line x1="14" y1="28" x2="12" y2="36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="26" y1="28" x2="28" y2="36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="10" y1="36" x2="30" y2="36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
    </svg>',

    'music_notes' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="30" r="4" stroke="'.$c.'" stroke-width="1.6"/>
      <circle cx="26" cy="26" r="4" stroke="'.$c.'" stroke-width="1.6"/>
      <line x1="16" y1="30" x2="16" y2="10" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="30" y1="26" x2="30" y2="6" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <path d="M16 10 L30 6" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
    </svg>',

    'home' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M4 20 L20 6 L36 20" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <rect x="8" y="20" width="24" height="16" rx="1" stroke="'.$c.'" stroke-width="1.8"/>
      <rect x="16" y="26" width="8" height="10" rx="1" stroke="'.$c.'" stroke-width="1.4"/>
    </svg>',

    'heart' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 34 C20 34 4 24 4 14 C4 9 8 6 12 6 C15 6 18 8 20 10 C22 8 25 6 28 6 C32 6 36 9 36 14 C36 24 20 34 20 34Z" stroke="'.$c.'" stroke-width="1.8" stroke-linejoin="round" fill="none"/>
    </svg>',

    'search' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="17" cy="17" r="11" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="25" y1="25" x2="36" y2="36" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
    </svg>',

    'star' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <polygon points="20,4 24,15 36,15 27,22 30,34 20,27 10,34 13,22 4,15 16,15" stroke="'.$c.'" stroke-width="1.8" stroke-linejoin="round" fill="none"/>
    </svg>',

    'come_follow_me' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="6" width="32" height="28" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="4" y1="14" x2="36" y2="14" stroke="'.$c.'" stroke-width="1.4"/>
      <line x1="12" y1="6" x2="12" y2="2" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="28" y1="6" x2="28" y2="2" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <path d="M12 22 L16 26 L26 20" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
    </svg>',

    'journal' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="6" y="4" width="26" height="34" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="6" y1="4" x2="6" y2="38" stroke="'.$c.'" stroke-width="3.5" stroke-linecap="round"/>
      <line x1="12" y1="14" x2="26" y2="14" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="12" y1="20" x2="26" y2="20" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="12" y1="26" x2="20" y2="26" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <path d="M22 28 L24 26 L28 30 L26 32 Z" fill="'.$c.'" opacity=".7"/>
    </svg>',

    'phone' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="10" y="2" width="20" height="36" rx="3" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="10" y1="8" x2="30" y2="8" stroke="'.$c.'" stroke-width="1.4"/>
      <line x1="10" y1="32" x2="30" y2="32" stroke="'.$c.'" stroke-width="1.4"/>
      <circle cx="20" cy="35" r="1.5" fill="'.$c.'"/>
      <rect x="14" y="12" width="12" height="14" rx="1" stroke="'.$c.'" stroke-width="1" opacity=".4"/>
    </svg>',

    'newspaper' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="6" width="28" height="30" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <rect x="28" y="10" width="8" height="22" rx="1" stroke="'.$c.'" stroke-width="1.4"/>
      <line x1="9" y1="14" x2="25" y2="14" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round"/>
      <line x1="9" y1="20" x2="25" y2="20" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
      <line x1="9" y1="26" x2="20" y2="26" stroke="'.$c.'" stroke-width="1.2" stroke-linecap="round"/>
    </svg>',

    'clock' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="20" r="16" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="20" y1="20" x2="20" y2="10" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <line x1="20" y1="20" x2="28" y2="24" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <circle cx="20" cy="20" r="2" fill="'.$c.'"/>
    </svg>',

    'headphones' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M8 22 C8 12 13 6 20 6 C27 6 32 12 32 22" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" fill="none"/>
      <rect x="4" y="22" width="8" height="12" rx="3" stroke="'.$c.'" stroke-width="1.6"/>
      <rect x="28" y="22" width="8" height="12" rx="3" stroke="'.$c.'" stroke-width="1.6"/>
    </svg>',

    'paint' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M10 30 L28 12 L32 16 L14 34 Z" stroke="'.$c.'" stroke-width="1.6" fill="none" stroke-linejoin="round"/>
      <rect x="28" y="8" width="6" height="8" rx="1" transform="rotate(45 31 12)" stroke="'.$c.'" stroke-width="1.4" fill="none"/>
      <path d="M10 30 L8 36 L14 34" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
    </svg>',

    'play' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="20" r="16" stroke="'.$c.'" stroke-width="1.8"/>
      <polygon points="16,14 16,26 28,20" fill="'.$c.'" opacity=".8"/>
    </svg>',

    'spotify' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="20" r="16" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M11 16 Q20 12 29 16" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" fill="none"/>
      <path d="M12 22 Q20 18 28 22" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <path d="M13 28 Q20 24 27 28" stroke="'.$c.'" stroke-width="1.4" stroke-linecap="round" fill="none"/>
    </svg>',

    'apple_podcast' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="4" width="32" height="32" rx="8" stroke="'.$c.'" stroke-width="1.8"/>
      <circle cx="20" cy="16" r="5" stroke="'.$c.'" stroke-width="1.6"/>
      <path d="M14 28 C14 24 26 24 26 28" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round" fill="none"/>
      <line x1="20" y1="21" x2="20" y2="28" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
    </svg>',

    'amazon' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="4" y="8" width="32" height="22" rx="2" stroke="'.$c.'" stroke-width="1.8"/>
      <path d="M10 36 Q20 32 30 36" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round" fill="none"/>
      <polygon points="16,14 16,24 26,19" fill="'.$c.'" opacity=".7"/>
    </svg>',

    'google_podcast' => '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="14" r="5" stroke="'.$c.'" stroke-width="1.8"/>
      <line x1="20" y1="19" x2="20" y2="26" stroke="'.$c.'" stroke-width="1.8" stroke-linecap="round"/>
      <line x1="10" y1="22" x2="10" y2="30" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="30" y1="22" x2="30" y2="30" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <circle cx="10" cy="18" r="4" stroke="'.$c.'" stroke-width="1.5"/>
      <circle cx="30" cy="18" r="4" stroke="'.$c.'" stroke-width="1.5"/>
      <line x1="8" y1="36" x2="12" y2="36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
      <line x1="28" y1="36" x2="32" y2="36" stroke="'.$c.'" stroke-width="1.6" stroke-linecap="round"/>
    </svg>',

  ];
  return isset($icons[$name]) ? $icons[$name] : '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 40 40"><circle cx="20" cy="20" r="16" stroke="'.$c.'" stroke-width="1.8" fill="none"/></svg>';
}

/* ── LDS ICON STYLES ── */
add_action('wp_head','af_icon_css',203);
function af_icon_css(){ ?>
<style id="af-icon-css">

/* All SVG icons inherit colour from parent */
.af-kids-card-icon svg,
.af-kres-icon svg,
.af-age-card-icon svg,
.af-activity-icon svg,
.af-kids-pillar-icon svg,
.af-about-pillar-icon svg,
.af-about-who-icon svg,
.af-pod-icon svg,
.af-conf-link-icon svg,
.af-conf-fact-icon svg,
.af-conf-tip-num svg,
.af-res-icon svg { display:block }

/* Kids resource cards — icon colour from card accent */
.af-kres-card.c1 svg { color:#2563EB }
.af-kres-card.c2 svg { color:var(--af-gold) }
.af-kres-card.c3 svg { color:var(--kd-teal,#0F7B6C) }
.af-kres-card.c4 svg { color:#DC2626 }
.af-kres-card.c5 svg { color:#7C3AED }
.af-kres-card.c6 svg { color:#D97706 }

/* Dark section icons — gold */
.af-kids-card svg,
.af-about-pillar svg,
.af-about-who-card svg,
.af-pod-about-visual svg,
.af-pod-icon svg,
.af-resources-desc + div svg { color:var(--af-gold) }

/* Conference watch cards */
.af-conf-link-card svg { color:var(--af-gold);width:48px;height:48px }

/* Conference fact cards */
.af-conf-fact-icon svg { color:var(--af-gold);width:36px;height:36px }

/* Podcast resource cards */
.af-pod-icon svg { color:#fff;width:28px;height:28px }

/* Activity items */
.af-activity-icon svg { color:var(--af-navy,#1B3356);width:32px;height:32px }

/* Age tab cards */
.af-age-card-icon svg { width:36px;height:36px }
.af-age-card.sky svg  { color:#2563EB }
.af-age-card.sun svg  { color:var(--af-gold) }
.af-age-card.mint svg { color:#0F7B6C }
.af-age-card.rose svg { color:#DC2626 }

/* About pillars */
.af-about-pillar-icon svg { color:var(--af-gold);width:32px;height:32px }
.af-about-who-icon svg    { color:var(--af-gold);width:44px;height:44px }

/* Kids pillar */
.af-kids-pillar-icon svg  { color:var(--af-navy,#1B3356);width:36px;height:36px }

/* Resource sidebar */
.af-res-icon svg { color:#fff;width:22px;height:22px }

/* Smooth hover on all icon cards */
.af-pathway-card:hover svg,
.af-video-card:hover svg,
.af-conf-link-card:hover svg { opacity:.9 }
</style>
<?php }

/* ── PODCAST EPISODE THUMBNAIL CSS ── */
add_action('wp_head','af_pod_thumb_css',204);
function af_pod_thumb_css(){ ?>
<style id="af-pod-thumb-css">

/* Episode row — new layout with thumbnail */
.af-pod-episode {
  display: grid !important;
  grid-template-columns: 200px 1fr auto !important;
  gap: 24px !important;
  align-items: center !important;
  cursor: pointer !important;
}

/* Thumbnail */
.af-pod-ep-thumb {
  position: relative;
  width: 200px;
  height: 112px;
  flex-shrink: 0;
  overflow: hidden;
  background: #000;
}
.af-pod-ep-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .5s ease, opacity .3s;
  opacity: .85;
}
.af-pod-episode:hover .af-pod-ep-thumb img {
  transform: scale(1.06);
  opacity: 1;
}

/* Play button overlay */
.af-pod-ep-play {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0,0,0,.35);
  transition: background .3s;
}
.af-pod-ep-play svg {
  filter: drop-shadow(0 2px 6px rgba(0,0,0,.5));
  transition: transform .3s;
}
.af-pod-episode:hover .af-pod-ep-play {
  background: rgba(184,151,90,.45);
}
.af-pod-episode:hover .af-pod-ep-play svg {
  transform: scale(1.15);
}

/* Duration overlay bottom right of thumb */
.af-pod-ep-dur-overlay {
  position: absolute;
  bottom: 6px;
  right: 8px;
  background: rgba(0,0,0,.75);
  color: #fff;
  font-family: 'Jost', sans-serif;
  font-size: 11px;
  font-weight: 500;
  padding: 2px 6px;
  letter-spacing: .04em;
}

/* Episode body text */
.af-pod-ep-body { flex: 1; min-width: 0; }

/* Watch arrow */
.af-pod-ep-watch {
  font-family: 'Jost', sans-serif;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--af-gold);
  white-space: nowrap;
  opacity: 0;
  transform: translateX(-8px);
  transition: opacity .3s, transform .3s;
  display: block;
  margin-top: 8px;
}
.af-pod-episode:hover .af-pod-ep-watch {
  opacity: 1;
  transform: translateX(0);
}

/* Gold left border on hover */
.af-pod-episode {
  border-left: 3px solid transparent !important;
  transition: background .3s, border-color .3s, transform .3s !important;
}
.af-pod-episode:hover {
  background: rgba(255,255,255,.07) !important;
  border-left-color: var(--af-gold) !important;
  transform: translateX(4px) !important;
}

/* Responsive */
@media(max-width:768px) {
  .af-pod-episode {
    grid-template-columns: 120px 1fr !important;
    gap: 16px !important;
  }
  .af-pod-ep-thumb { width: 120px; height: 68px; }
  .af-pod-ep-meta  { display: none; }
}
</style>
<?php }

/* ── WHERE TO LISTEN REDESIGN CSS ── */
add_action('wp_head','af_where_css',205);
function af_where_css(){ ?>
<style id="af-where-css">

/* Even 3-column grid */
.af-pod-platforms-grid {
  display: grid !important;
  grid-template-columns: repeat(3,1fr) !important;
  gap: 16px !important;
  max-width: 900px !important;
  margin: 0 auto !important;
  background: transparent !important;
}

/* Platform cards — bright & clear */
.af-pod-plat-card {
  background: rgba(255,255,255,.07) !important;
  border: 1px solid rgba(255,255,255,.15) !important;
  padding: 36px 24px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 12px !important;
  text-decoration: none !important;
  transition: all .3s !important;
  border-radius: 0 !important;
  opacity: 1 !important;
  transform: none !important;
}
.af-pod-plat-card.af-visible {
  opacity: 1 !important;
  transform: none !important;
}
.af-pod-plat-card:hover {
  background: rgba(255,255,255,.13) !important;
  border-color: var(--plat-color, var(--af-gold)) !important;
  transform: translateY(-6px) !important;
  box-shadow: 0 12px 40px rgba(0,0,0,.3) !important;
}
.af-pod-plat-icon svg {
  display: block;
  filter: drop-shadow(0 2px 6px rgba(0,0,0,.3));
  transition: transform .3s;
}
.af-pod-plat-card:hover .af-pod-plat-icon svg {
  transform: scale(1.1);
}
.af-pod-plat-name {
  font-family: 'Cormorant Garamond', serif !important;
  font-size: 20px !important;
  font-weight: 400 !important;
  color: #fff !important;
}
.af-pod-plat-sub {
  font-family: 'Jost', sans-serif !important;
  font-size: 13px !important;
  color: rgba(255,255,255,.7) !important;
  font-weight: 300 !important;
  text-align: center !important;
}

/* Channel banner */
.af-pod-channel-banner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(255,0,0,.1);
  border: 1px solid rgba(255,0,0,.3);
  padding: 20px 32px;
  max-width: 900px;
  margin: 0 auto 40px;
  flex-wrap: wrap;
  gap: 16px;
}
.af-pod-channel-left {
  display: flex;
  align-items: center;
  gap: 16px;
}
.af-pod-channel-label {
  font-family: 'Jost', sans-serif;
  font-size: 11px;
  letter-spacing: .16em;
  text-transform: uppercase;
  color: rgba(255,255,255,.55);
  font-weight: 500;
  margin: 0 0 4px;
}
.af-pod-channel-name {
  font-family: 'Cormorant Garamond', serif;
  font-size: 22px;
  font-weight: 300;
  color: #fff;
  margin: 0;
}
.af-pod-channel-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #FF0000;
  color: #fff !important;
  font-family: 'Jost', sans-serif;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: .12em;
  text-transform: uppercase;
  padding: 12px 28px;
  text-decoration: none !important;
  transition: all .3s;
  flex-shrink: 0;
}
.af-pod-channel-btn:hover {
  background: #CC0000;
  transform: translateY(-2px);
}

@media(max-width:768px){
  .af-pod-platforms-grid { grid-template-columns: 1fr 1fr !important; }
  .af-pod-channel-banner { padding: 16px 20px; }
}
@media(max-width:480px){
  .af-pod-platforms-grid { grid-template-columns: 1fr !important; }
}
</style>
<?php }

/* ── HERO ARROW REDESIGN ── */
add_action('wp_head','af_hero_arrows_css',206);
function af_hero_arrows_css(){ ?>
<style id="af-hero-arrows">

/* Move arrows to LEFT and RIGHT sides — centered vertically */
.af-hero-wrap .bx-wrapper .bx-controls-direction {
  position: absolute !important;
  bottom: auto !important;
  right: auto !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 0 !important;
  z-index: 50 !important;
}

/* Both arrows — side style */
.af-hero-wrap .bx-wrapper .bx-controls-direction a {
  pointer-events: all !important;
  position: relative !important;
  width: 56px !important;
  height: 56px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  background: rgba(0,0,0,.35) !important;
  border: 1px solid rgba(255,255,255,.25) !important;
  color: #fff !important;
  font-size: 0 !important; /* hide text */
  margin: 0 !important;
  float: none !important;
  text-decoration: none !important;
  transition: background .3s, border-color .3s, transform .3s !important;
  backdrop-filter: blur(4px);
}
.af-hero-wrap .bx-wrapper .bx-controls-direction a:hover {
  background: rgba(184,151,90,.6) !important;
  border-color: var(--af-gold) !important;
  transform: scale(1.08) !important;
}

/* Remove old text content */
.af-hero-wrap .bx-wrapper .bx-prev::before,
.af-hero-wrap .bx-wrapper .bx-next::before {
  content: '' !important;
  display: none !important;
}

/* SVG arrows via background */
.af-hero-wrap .bx-wrapper .bx-prev::after {
  content: '';
  display: block;
  width: 22px;
  height: 22px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='15 18 9 12 15 6'%3E%3C/polyline%3E%3C/svg%3E");
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}
.af-hero-wrap .bx-wrapper .bx-next::after {
  content: '';
  display: block;
  width: 22px;
  height: 22px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='9 18 15 12 9 6'%3E%3C/polyline%3E%3C/svg%3E");
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}

/* Prev on far left, Next on far right */
.af-hero-wrap .bx-wrapper .bx-prev {
  margin-left: 20px !important;
}
.af-hero-wrap .bx-wrapper .bx-next {
  margin-right: 20px !important;
}

/* Pulse animation to draw attention on load */
.af-hero-wrap .bx-wrapper .bx-controls-direction a {
  animation: af-arrow-pulse 3s ease-in-out 2s 3;
}
@keyframes af-arrow-pulse {
  0%,100% { box-shadow: 0 0 0 0 rgba(184,151,90,0); }
  50%      { box-shadow: 0 0 0 8px rgba(184,151,90,.25); }
}

/* Pager dots — move above arrows, centered bottom */
.af-hero-wrap .bx-wrapper .bx-pager {
  position: absolute !important;
  bottom: 32px !important;
  left: 50% !important;
  transform: translateX(-50%) !important;
  text-align: center !important;
}
.af-hero-wrap .bx-wrapper .bx-pager.bx-default-pager a {
  width: 28px !important;
  height: 4px !important;
  border-radius: 2px !important;
  margin: 0 4px !important;
}
.af-hero-wrap .bx-wrapper .bx-pager.bx-default-pager a.active {
  width: 52px !important;
  background: var(--af-gold) !important;
}

/* Slide counter — keep on right */
.af-slide-counter {
  right: 80px !important;
}

/* Mobile — smaller arrows */
@media(max-width:768px) {
  .af-hero-wrap .bx-wrapper .bx-controls-direction a {
    width: 40px !important;
    height: 40px !important;
  }
  .af-hero-wrap .bx-wrapper .bx-prev { margin-left: 10px !important; }
  .af-hero-wrap .bx-wrapper .bx-next { margin-right: 10px !important; }
  .af-slide-counter { display: none !important; }
}
</style>
<?php }

/* ── PERFORMANCE — preload fonts + instant hero ── */
add_action('wp_head','af_performance_head', 1);
function af_performance_head(){ ?>
<!-- Preload hero images -->
<link rel="preload" as="image" href="/wp-content/uploads/2026/01/Homepage.jpg">
<!-- Preload Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<style id="af-perf">
/* Show first slide instantly before JS loads — no layout shift */
.af-hero-wrap .bxslider li:first-child {
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
}
/* Skeleton — hero never collapses to 0 height while JS loads */
.af-hero-wrap {
  min-height: calc(100vh - 76px) !important;
}
.af-hero-wrap .bx-viewport {
  min-height: calc(100vh - 76px) !important;
}
/* Remove bxSlider loading spinner flash */
.bx-wrapper .bx-loading {
  display: none !important;
}
/* Smooth fade in for slide content */
.af-slide-content {
  will-change: opacity, transform;
}
/* Lazy load non-first slide backgrounds */
.af-hero-wrap .bxslider li:not(:first-child) .af-slide-bg {
  content-visibility: auto;
}
</style>
<?php }

/* ============================================================
   [af_listen] — Audio player for posts
   ============================================================ */
add_shortcode('af_listen', 'af_listen_shortcode');
function af_listen_shortcode() {
    $post_id = get_the_ID();
    $text    = '';
    if ( $post_id ) {
        $post = get_post( $post_id );
        if ( $post ) {
            $text = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
            $text = preg_replace( '/\s+/', ' ', trim( $text ) );
        }
    }
    $js_text = esc_js( $text );
    ob_start();
    echo '<div id="af-listen-wrap" style="position:relative;left:50%;right:50%;margin-left:-50vw;margin-right:-50vw;width:100vw;max-width:100vw;background:#1B3356;border-bottom:3px solid #B8975A;font-family:Jost,sans-serif;">';
    echo '<div style="padding:14px 32px;max-width:1200px;margin:0 auto;">';
    echo '<table style="width:100%;border-collapse:collapse;"><tr>';
    echo '<td style="width:200px;white-space:nowrap;vertical-align:middle;padding-right:20px;">';
    echo '<button id="af-play-btn" onclick="afPlay()" style="display:inline-flex;align-items:center;gap:8px;background:#B8975A;color:#fff;border:none;cursor:pointer;padding:12px 20px;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;font-family:Jost,sans-serif;">';
    echo '<svg id="af-ico-play" width="14" height="14" viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg>';
    echo '<svg id="af-ico-pause" width="14" height="14" viewBox="0 0 24 24" style="display:none"><rect x="6" y="4" width="4" height="16" fill="white"/><rect x="14" y="4" width="4" height="16" fill="white"/></svg>';
    echo '<span id="af-btn-lbl">Listen</span></button></td>';
    echo '<td style="vertical-align:middle;padding-right:16px;">';
    echo '<div style="height:4px;background:rgba(255,255,255,.2);position:relative;"><div id="af-fill" style="position:absolute;top:0;left:0;height:4px;background:#B8975A;width:0%;transition:width .8s linear;"></div></div>';
    echo '<div style="display:flex;justify-content:space-between;margin-top:4px;font-size:11px;color:rgba(255,255,255,.5);"><span id="af-cur">0:00</span><span id="af-dur">--:--</span></div>';
    echo '</td>';
    echo '<td style="width:50px;vertical-align:middle;text-align:center;padding-right:10px;">';
    echo '<button id="af-spd" onclick="afSpd()" style="background:transparent;border:1px solid rgba(255,255,255,.3);color:rgba(255,255,255,.8);padding:5px 8px;font-size:12px;font-weight:700;font-family:Jost,sans-serif;cursor:pointer;">1x</button>';
    echo '</td>';
    echo '<td style="width:36px;vertical-align:middle;text-align:center;">';
    echo '<button onclick="afClose()" style="background:transparent;border:none;color:rgba(255,255,255,.4);font-size:20px;cursor:pointer;line-height:1;">x</button>';
    echo '</td>';
    echo '</tr></table></div>';
    echo '<div id="af-wave" style="display:none;text-align:center;padding:4px;background:rgba(0,0,0,.15);">';
    for ( $i = 0; $i < 20; $i++ ) {
        $dur = round( 0.7 + ( $i % 4 ) * 0.15, 2 );
        $del = round( $i * 0.06, 2 );
        echo '<span style="display:inline-block;width:3px;height:4px;background:#B8975A;border-radius:2px;margin:0 1px;animation:afwv ' . $dur . 's ease-in-out infinite alternate ' . $del . 's;"></span>';
    }
    echo '</div>';
    echo '<style>@keyframes afwv{0%{height:3px;opacity:.3}100%{height:18px;opacity:1}}</style>';
    ?>
    <script>
    (function(){
      var TEXT='<?php echo $js_text; ?>';
      var SPEEDS=[0.8,1,1.25,1.5,2],si=1,paused=false,timer=null,total=0,tstart=0,elapsed=0;
      function fmt(s){s=Math.round(s);return Math.floor(s/60)+':'+(('0'+s%60).slice(-2));}
      function ui(state){
        var p=document.getElementById('af-ico-play'),u=document.getElementById('af-ico-pause'),l=document.getElementById('af-btn-lbl'),w=document.getElementById('af-wave');
        if(state==='playing'){p.style.display='none';u.style.display='inline';l.textContent='Pause';w.style.display='block';}
        else if(state==='paused'){p.style.display='inline';u.style.display='none';l.textContent='Resume';w.style.display='none';}
        else{p.style.display='inline';u.style.display='none';l.textContent='Listen';w.style.display='none';}
      }
      function tick(){clearInterval(timer);tstart=Date.now()-elapsed*1000;timer=setInterval(function(){if(paused)return;elapsed=(Date.now()-tstart)/1000;var pct=total>0?Math.min(elapsed/total*100,100):0;document.getElementById('af-fill').style.width=pct+'%';document.getElementById('af-cur').textContent=fmt(elapsed);},800);}
      window.afPlay=function(){
        if(!('speechSynthesis' in window)){alert('Text-to-speech not supported. Please use Chrome or Edge.');return;}
        if(paused){speechSynthesis.resume();paused=false;ui('playing');tick();return;}
        if(speechSynthesis.speaking){speechSynthesis.pause();paused=true;ui('paused');clearInterval(timer);return;}
        if(!TEXT||TEXT.length<10){alert('No article content found.');return;}
        var words=TEXT.split(/\s+/).length;
        total=Math.round(words/150*60/SPEEDS[si]);
        document.getElementById('af-dur').textContent=fmt(total);
        var u=new SpeechSynthesisUtterance(TEXT);
        u.rate=SPEEDS[si];u.pitch=1;u.lang='en';
        u.onstart=function(){elapsed=0;ui('playing');tick();};
        u.onend=function(){ui('idle');clearInterval(timer);document.getElementById('af-fill').style.width='100%';document.getElementById('af-cur').textContent=fmt(total);document.getElementById('af-btn-lbl').textContent='Listen again';paused=false;elapsed=0;};
        u.onerror=function(e){console.log('TTS',e);ui('idle');clearInterval(timer);};
        speechSynthesis.cancel();
        speechSynthesis.speak(u);
        var ka=setInterval(function(){if(!speechSynthesis.speaking){clearInterval(ka);return;}speechSynthesis.pause();speechSynthesis.resume();},14000);
      };
      window.afSpd=function(){si=(si+1)%SPEEDS.length;document.getElementById('af-spd').textContent=SPEEDS[si]+'x';if(speechSynthesis.speaking||paused){speechSynthesis.cancel();paused=false;elapsed=0;clearInterval(timer);ui('idle');document.getElementById('af-fill').style.width='0%';document.getElementById('af-cur').textContent='0:00';}};
      window.afClose=function(){speechSynthesis.cancel();clearInterval(timer);document.getElementById('af-listen-wrap').style.display='none';};
      window.addEventListener('beforeunload',function(){speechSynthesis.cancel();});
    })();
    </script>
    <?php
    echo '</div>';
    return ob_get_clean();
}
