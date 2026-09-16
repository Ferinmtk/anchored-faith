(function($){
  'use strict';

  function initSlider() {
    var $slider = $('.af-hero-wrap .bxslider');
    if (!$slider.length) return;
    if ($slider.data('bxSlider')) return; // already init

    var total = $slider.children('li').length;

    var slider = $slider.bxSlider({
      mode:            'fade',
      speed:           1200,
      auto:            true,
      pause:           5000,
      autoHover:       true,
      controls:        true,
      pager:           true,
      prevText:        '←',
      nextText:        '→',
      keyboardEnabled: true,
      touchEnabled:    true,
      onSliderLoad: function(){
        afAnimateSlideContent($slider.find('li:first-child .af-slide-content'));
        afUpdateCounter(0, total);
      },
      onSlideBefore: function($el, oldIdx, newIdx){
        afUpdateCounter(newIdx, total);
      },
      onSlideAfter: function($el){
        afAnimateSlideContent($el.find('.af-slide-content'));
      }
    });
  }

  function afAnimateSlideContent($el){
    $el.css({ opacity: 0, transform: 'translateY(30px)' });
    setTimeout(function(){
      $el.css({
        transition: 'opacity 0.9s cubic-bezier(.16,1,.3,1), transform 0.9s cubic-bezier(.16,1,.3,1)',
        opacity: 1,
        transform: 'translateY(0)'
      });
    }, 80);
  }

  function afUpdateCounter(idx, total){
    var $counter = $('.af-slide-counter');
    if (!$counter.length) return;
    $counter.find('.af-cur').text(String(idx + 1).padStart(2, '0'));
    $counter.find('.af-tot').text(String(total).padStart(2, '0'));
  }

  function afReveal(){
    var wTop = $(window).scrollTop();
    var wH   = $(window).height();
    $('.af-reveal, .af-reveal-left, .af-reveal-right').each(function(){
      if ($(this).offset().top < wTop + wH - 80) {
        $(this).addClass('af-visible');
      }
    });
  }

  // Progress bar
  $('body').prepend('<div id="af-progress"></div>');
  $(window).on('scroll.af', function(){
    var st   = $(this).scrollTop();
    var docH = $(document).height() - $(window).height();
    $('#af-progress').css('width', (st / docH * 100) + '%');
    afReveal();
  });

  // Try on DOM ready
  $(function(){
    initSlider();
    setTimeout(afReveal, 300);
  });

  // Also try after Elementor frontend loads (handles Elementor delay)
  $(window).on('elementor/frontend/init', function(){
    setTimeout(initSlider, 500);
  });

  // Fallback — try again after full page load
  $(window).on('load', function(){
    setTimeout(initSlider, 300);
  });

})(jQuery);

/* ── KIDS PAGE ANIMATIONS ── */
(function($){
  $(window).on('load', function(){

    // Animate kids hero title words one by one
    var $title = $('.af-kids-hero-v2-title');
    if($title.length){
      var html = $title.html();
      var words = html.split(/(\s+|<[^>]+>)/);
      var wrapped = words.map(function(w){
        if(w.match(/^</) || w.match(/^\s+$/)) return w;
        return '<span class="af-word" style="opacity:0;transform:translateY(24px);display:inline-block;transition:opacity .6s cubic-bezier(.16,1,.3,1),transform .6s cubic-bezier(.16,1,.3,1)">' + w + '</span>';
      });
      $title.html(wrapped.join(''));
      setTimeout(function(){
        $title.find('.af-word').each(function(i){
          var $w = $(this);
          setTimeout(function(){ $w.css({opacity:1,transform:'translateY(0)'}); }, i * 80);
        });
      }, 400);
    }

    // Pulse the scripture verse
    var $verse = $('.af-kids-verse-text');
    if($verse.length){
      $verse.css({opacity:0,transform:'scale(.96)'});
      setTimeout(function(){
        $verse.css({transition:'opacity 1.2s ease, transform 1.2s ease', opacity:1, transform:'scale(1)'});
      }, 300);
    }

    // Animate age tab cards when tab switches
    $(document).on('click','.af-age-tab', function(){
      setTimeout(function(){
        $('.af-age-panel.active .af-age-card').each(function(i){
          var $c = $(this);
          $c.css({opacity:0, transform:'translateY(20px)'});
          setTimeout(function(){
            $c.css({transition:'opacity .5s ease, transform .5s ease', opacity:1, transform:'translateY(0)'});
          }, i * 100);
        });
      }, 50);
    });

    // Floating animation on kids hero image
    var $img = $('.af-kids-hero-v2-img img');
    if($img.length){
      var up = true, pos = 0;
      setInterval(function(){
        pos = up ? 8 : 0;
        up = !up;
        $img.css({transition:'transform 3s ease-in-out', transform:'translateY(-'+pos+'px)'});
      }, 3000);
    }

    // Count-up on stats if any visible
    function animateCount($el){
      var target = parseInt($el.data('count'));
      var duration = 1800;
      var step = target / (duration / 16);
      var current = 0;
      var timer = setInterval(function(){
        current += step;
        if(current >= target){ current = target; clearInterval(timer); }
        $el.text(Math.floor(current));
      }, 16);
    }
    $('.af-count').each(function(){
      var $el = $(this);
      var observer = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
          if(entry.isIntersecting){ animateCount($el); observer.disconnect(); }
        });
      });
      observer.observe($el[0]);
    });

    // Stagger kids resource cards on scroll
    var cardObserver = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $card = $(entry.target);
          var idx = $card.index();
          setTimeout(function(){
            $card.css({opacity:1, transform:'translateY(0)'});
          }, idx * 120);
          cardObserver.unobserve(entry.target);
        }
      });
    }, {threshold: 0.1});

    $('.af-kres-card, .af-kids-pillar').each(function(){
      $(this).css({opacity:0, transform:'translateY(32px)', transition:'opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1)'});
      cardObserver.observe(this);
    });

    // Kids activity items slide in from left
    var actObserver = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $item = $(entry.target);
          var idx = $item.index();
          setTimeout(function(){
            $item.css({opacity:1, transform:'translateX(0)'});
          }, idx * 150);
          actObserver.unobserve(entry.target);
        }
      });
    }, {threshold: 0.1});

    $('.af-activity-item, .af-podcast-preview').each(function(){
      $(this).css({opacity:0, transform:'translateX(-32px)', transition:'opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1)'});
      actObserver.observe(this);
    });

    // Shine sweep on featured badge
    var $badge = $('.af-kids-featured-badge');
    if($badge.length){
      setInterval(function(){
        $badge.addClass('af-shine');
        setTimeout(function(){ $badge.removeClass('af-shine'); }, 600);
      }, 4000);
    }

    // Scripture verse sparkle dots
    var $verseWrap = $('.af-kids-verse-inner');
    if($verseWrap.length){
      for(var i=0;i<6;i++){
        (function(i){
          var $dot = $('<span>').css({
            position:'absolute', width:'6px', height:'6px',
            borderRadius:'50%', background:'#F5C842',
            top: Math.random()*100+'%', left: Math.random()*100+'%',
            opacity:0, animation:'af-sparkle '+(2+Math.random()*2)+'s infinite '+(i*0.4)+'s'
          });
          $verseWrap.css('position','relative').append($dot);
        })(i);
      }
    }

  });
})(jQuery);

/* ── PODCAST PAGE ANIMATIONS ── */
(function($){
  $(window).on('load', function(){

    // Stagger episodes on scroll
    var epObserver = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $ep = $(entry.target);
          var idx = $ep.index('.af-pod-episode');
          setTimeout(function(){
            $ep.addClass('af-visible');
          }, idx * 100);
          epObserver.unobserve(entry.target);
        }
      });
    },{threshold:0.1});
    $('.af-pod-episode').each(function(){
      epObserver.observe(this);
    });

    // Stagger platform cards
    var platObserver = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $c = $(entry.target);
          var idx = $c.index('.af-pod-plat-card');
          setTimeout(function(){
            $c.addClass('af-visible');
          }, idx * 120);
          platObserver.unobserve(entry.target);
        }
      });
    },{threshold:0.1});
    $('.af-pod-plat-card').each(function(){
      platObserver.observe(this);
    });

    // Episode hover — highlight number
    $('.af-pod-episode').on('mouseenter', function(){
      $(this).find('.af-pod-ep-num').css({
        color:'rgba(184,151,90,.6)',
        transition:'color .3s'
      });
    }).on('mouseleave', function(){
      $(this).find('.af-pod-ep-num').css({color:'rgba(255,255,255,.15)'});
    });

  });
})(jQuery);

/* ── ABOUT US ANIMATIONS ── */
(function($){
  $(window).on('load', function(){

    // Stagger pillars, who cards and belief items
    var aboutObserver = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $el = $(entry.target);
          var idx = $el.index('.af-about-pillar, .af-about-who-card, .af-about-belief-item');
          setTimeout(function(){
            $el.addClass('af-visible');
          }, (idx % 4) * 130);
          aboutObserver.unobserve(entry.target);
        }
      });
    },{threshold:0.12});

    $('.af-about-pillar, .af-about-who-card, .af-about-belief-item').each(function(){
      aboutObserver.observe(this);
    });

    // Parallax on about hero bg
    $(window).on('scroll.about', function(){
      var $bg = $('.af-about-hero-bg');
      if($bg.length){
        var scroll = $(window).scrollTop();
        $bg.css('transform','translateY('+(scroll*0.3)+'px) scale(1.1)');
      }
    });

    // Animate pull quote border on scroll
    var $pull = $('.af-about-pull');
    if($pull.length){
      var pullObs = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
          if(entry.isIntersecting){
            $pull.css({
              borderLeft:'3px solid var(--af-gold)',
              transition:'padding-left .6s ease',
              paddingLeft:'36px'
            });
            pullObs.disconnect();
          }
        });
      },{threshold:0.5});
      pullObs.observe($pull[0]);
    }

    // CTA buttons stagger
    var ctaObs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          $('.af-about-cta-btn').each(function(i){
            var $b = $(this);
            $b.css({opacity:0,transform:'translateY(16px)'});
            setTimeout(function(){
              $b.css({
                transition:'opacity .6s ease, transform .6s ease, background .3s, color .3s, border-color .3s',
                opacity:1,transform:'translateY(0)'
              });
            }, i * 150);
          });
          ctaObs.disconnect();
        }
      });
    },{threshold:0.3});
    if($('.af-about-cta').length) ctaObs.observe($('.af-about-cta')[0]);

  });
})(jQuery);

/* ── CONFERENCE PAGE ANIMATIONS ── */
(function($){
  $(window).on('load', function(){

    // Stagger conference link cards
    var confLinkObs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $c = $(entry.target);
          var idx = $c.index('.af-conf-link-card');
          setTimeout(function(){ $c.addClass('af-visible'); }, idx * 110);
          confLinkObs.unobserve(entry.target);
        }
      });
    },{threshold:0.1});
    $('.af-conf-link-card').each(function(){ confLinkObs.observe(this); });

    // Stagger session rows
    var sessObs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var $s = $(entry.target);
          var idx = $s.index('.af-conf-session');
          setTimeout(function(){ $s.addClass('af-visible'); }, idx * 120);
          sessObs.unobserve(entry.target);
        }
      });
    },{threshold:0.1});
    $('.af-conf-session').each(function(){ sessObs.observe(this); });

  });
})(jQuery);
