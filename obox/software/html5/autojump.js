(function() {
    ///Extra settings for adding values to quadrants
    W.autojumpmethod = 2;
    
    W.autoicondiagonaladdqw1 = 0;  //quadrant 1 addition diagonal position offset
    W.autoicondiagonaladdqw2 = 0;//50; //quadrant 2 addition diagonal position offset
    W.autoicondiagonaladdqw3 = 0;//50; //quadrant 3 addition diagonal position offset
    W.autoicondiagonaladdqw4 = 0;//50; //quadrant 4 addition diagonal position offset
    W.prevarea = 1;
    
    if(W.autojumpmethod == 1) {
      W.AutoJump = function() {
        if(W.autoiconjump) {
          W.setTimeout(function() { 
                    var mousewidth = ML.V.width + ML.V.width2;
                    var mouseheight = ML.V.height + ML.V.height2;
                    if(W.lposy < W.maxh2 && W.lposx < W.maxw2) { 
                       //when user enters left top area
                       if(W.prevarea != 1) { 
                           W.prevarea = 1; 
                           if(W.forceFollow() && W.autoicondiagonaladdqw1 > 0) {
                             ML.V.left += W.autoicondiagonaladdqw1;
                             ML.V.top  += W.autoicondiagonaladdqw1;
                             W.adjustIconPosition();
                           }
                       }
                    } else if(W.lposy < W.maxh2 && W.lposx > W.maxw2) { 
                       //when user enters right top area
                       if(W.prevarea != 2) { 
                           W.prevarea = 2; 
                           if(W.forceFollow()) {
                             ML.V.left -= (mousewidth + W.autoicondiagonaladdqw2);
                             ML.V.top  += W.autoicondiagonaladdqw2;
                             W.adjustIconPosition();
                           }
                        
                       }
                    } else if(W.lposy > W.maxh2 && W.lposx < W.maxw2) { 
                       //when user enters bottom left area
                       if(W.prevarea != 3) { 
                           W.prevarea = 3;
                           if(W.forceFollow()) {
                             ML.V.left += W.autoicondiagonaladdqw3;
                             ML.V.top -= (mouseheight + W.autoicondiagonaladdqw3);
                             W.adjustIconPosition();
                           }
                       }
                    } else if(W.lposy > W.maxh2 && W.lposx > W.maxw2) { 
                       //when user enters botton right area
                       if(W.prevarea != 4) { 
                           W.prevarea = 4;
                           if(W.forceFollow()) {
                             ML.V.left -= (mousewidth + W.autoicondiagonaladdqw4);
                             ML.V.top  -= (mouseheight + W.autoicondiagonaladdqw4);
                             W.adjustIconPosition();
                           }
                       }
                    }    
          },0);
        } else { W.AutoJump = function() { }; W.AutoJumpMove = function() { }; } 
      }
    
      W.AutoJumpMove = function() { W.AutoJump(); }
    
    } else if(W.autojumpmethod == 2) {
      ///here may come different implementation
    
      W.AutoJumpM2 = function(lposx, lposy) {
                    var mousewidth = ML.V.width + ML.V.width2;
                    var mouseheight = ML.V.height + ML.V.height2;
                    var mousewidthcur = Math.round((ML.V.width + 22) * 1.2);
                    var mouseheightcur = Math.round((ML.V.height + 22) * 1.2);
    
                    var area2x = W.maxw - mousewidthcur;
                    var area2y = W.maxh - mouseheightcur;
    
                    var area3y = area2y;
                    var area3x = Math.round(area2x - (area2x/10));
    
                    if(lposx > area2x) { 
                      if(lposy < area2y) {
                           W.prevarea = 2;
                           if(W.forceFollow()) {
                             ML.V.left -= (mousewidth + W.autoicondiagonaladdqw2);
                             ML.V.top  += W.autoicondiagonaladdqw2;
                             W.adjustIconPosition();
                           }
                      } else { 
                         W.prevarea = 4;
                           if(W.forceFollow()) {
                             ML.V.left -= (mousewidth + W.autoicondiagonaladdqw4);
                             ML.V.top  -= (mouseheight + W.autoicondiagonaladdqw4);
                             W.adjustIconPosition();
                           }         
                      }
                    } else if(lposy > area3y) {
                      if(lposx < area3x) {
                           W.prevarea = 3;
                           if(W.forceFollow()) {
                             ML.V.left += W.autoicondiagonaladdqw3;
                             ML.V.top -= (mouseheight + W.autoicondiagonaladdqw3);
                             W.adjustIconPosition();
                           }
                      } else { 
                         W.prevarea = 4;
                           if(W.forceFollow()) {
                             ML.V.left -= (mousewidth + W.autoicondiagonaladdqw4);
                             ML.V.top  -= (mouseheight + W.autoicondiagonaladdqw4);
                             W.adjustIconPosition();
                           }
                      }
                    } else if(W.prevarea != 1) { 
                       W.prevarea = 1;
                       if(W.forceFollow() && W.autoicondiagonaladdqw1 > 0) {
                         ML.V.left += W.autoicondiagonaladdqw1;
                         ML.V.top  += W.autoicondiagonaladdqw1;
                         W.adjustIconPosition();
                       }
                    } else { return false; }
                    return true;
      }
    
    
      W.AutoJump = function() { 
        if(W.autoiconjump) {
          W.setTimeout(function() {
              W.AutoJumpM2(W.lposx, W.lposy);
          },0);
        } else { W.AutoJump = function() { }; W.AutoJumpMove = function() { }; } 
      }
    
      W.AutoJumpMove = function() { 
        if(W.autoiconjump) {
          W.setTimeout(function() { 
              if(!W.AutoJumpM2(W.lposx, W.lposy)) {
                W.forceFollow();
              }
          },0);
        } else { W.AutoJumpMove = function() { }; W.AutoJump = function() { }; } 
      }
    }
    
    W.jumpAfterIconMove = function() { try { W.AutoJumpMove(); } catch(e) { W.alertDiv("Error AutoJumpMove: " + e, 10000); } }
    
    W.jumpAfterScreenClick = function() { try { W.AutoJump(); } catch(e) { W.alertDiv("Error jumpAfterScreenClick: " + e, 10000); } }
})();