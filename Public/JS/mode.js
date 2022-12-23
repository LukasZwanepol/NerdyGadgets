window.addEventListener('load', function() {
    var mode = localStorage.getItem('mode');

    if (mode == 'dark'){        
        var Content = document.getElementById("Content");
        if(Content){
            Content.classList.add('dark');
            Content.classList.remove('bg-white');
        } 
        var CenteredContent = document.getElementById("CenteredContent");
        if(CenteredContent){
            document.getElementById("StockItemDescription").classList.remove('bg-white')
            document.getElementById("StockItemDescription").classList.add('dark');
            CenteredContent.classList.remove('bg-white');
            CenteredContent.classList.add('dark');
        } 
        var navbar = document.getElementById("navbar");
        if(navbar){
            navbar.classList.remove('dark');
        }
        var resultArea = document.getElementById("ResultsArea");
        if(resultArea){
            resultArea.classList.remove('bg-dark');
        }
        var Wrap = document.getElementById("Wrap");
        if(Wrap){
            Wrap.classList.remove('dark', 'p-4', 'rounded');
        }
        var CheckoutData = document.getElementById("CheckoutData");
        if(CheckoutData){
            CheckoutData.classList.remove('dark');
        }
        
        // change item cards panel to light and remove dark mode
        var orderForms = document.querySelectorAll('.orderForm');
        if(orderForms){
            orderForms.forEach(function(orderForm){
                orderForm.classList.add('bg-dark');
                orderForm.classList.remove('bg-light');
                orderForm.classList.add('text-light');
                orderForm.classList.remove('text-dark');
            });
        }

        // change item cards panel to light and remove dark mode
        var productFrames = document.querySelectorAll('.ProductFrame');
        if(productFrames){
            productFrames.forEach(function(productFrame){
                productFrame.classList.remove('bg-dark');
                productFrame.classList.remove('text-light');
            });
        }

        // change table panel to light and remove dark mode
        var tables = document.querySelectorAll('.table');
        if(tables){
            tables.forEach(function(table){
                table.classList.add('bg-dark');
                table.classList.remove('bg-light');
                table.classList.add('text-light');
                table.classList.remove('text-dark');
            });
        }
        // change cards panel to light and remove dark mode
        var cards = document.querySelectorAll('.card');
        if(cards){
            cards.forEach(function(card){
                card.classList.remove('bg-dark');
                card.classList.add('bg-light');
                card.classList.remove('text-light');
                card.classList.add('text-dark');
            }); 
        }
    }

    if(mode == 'light'){
        var Content = document.getElementById("Content");
        if(Content){
            Content.classList.add('bg-white');
            Content.classList.remove('dark');
        }
        var CenteredContent = document.getElementById("CenteredContent");
        if(CenteredContent){
            document.getElementById("StockItemDescription").classList.add('dark');
            document.getElementById("StockItemDescription").classList.remove('bg-white')
            CenteredContent.classList.add('dark');
            CenteredContent.classList.remove('bg-white');
        }
        var navbar = document.getElementById("navbar");
        if(navbar){
            navbar.classList.add('dark');
        }
        var resultArea = document.getElementById("ResultsArea")
        if(resultArea){
            resultArea.classList.add('bg-dark');
        }
        var Wrap = document.getElementById("Wrap");
        if(Wrap){
            Wrap.classList.add('dark', 'p-4', 'rounded');
        }
        var CheckoutData = document.getElementById("CheckoutData");
        if(CheckoutData){
            CheckoutData.classList.add('dark');
        }

        // change item cards panel to light and remove dark mode
        var orderForms = document.querySelectorAll('.orderForm');
        if(orderForms){
            orderForms.forEach(function(orderForm){
                orderForm.classList.add('bg-dark');
                orderForm.classList.remove('bg-light');
                orderForm.classList.add('text-light');
                orderForm.classList.remove('text-dark');
            });
        }

        // change item cards panel to light and remove dark mode
        var productFrames = document.querySelectorAll('.ProductFrame');
        if(productFrames){
            productFrames.forEach(function(productFrame){
                productFrame.classList.add('bg-dark');
                productFrame.classList.remove('bg-light');
                productFrame.classList.add('text-light');
                productFrame.classList.remove('text-dark');
            });
        }

        // change table panel to light and remove dark mode
        var tables = document.querySelectorAll('.table');
        if(tables){
            tables.forEach(function(table){
                table.classList.remove('bg-dark');
                table.classList.add('bg-light');
                table.classList.remove('text-light');
                table.classList.add('text-dark');
            });
        }

        // change cards panel to light and remove dark mode
        var cards = document.querySelectorAll('.card');
        if(cards){
            cards.forEach(function(card){
                card.classList.add('bg-dark');
                card.classList.remove('bg-light');
                card.classList.add('text-light');
                card.classList.remove('text-dark');
            }); 
        }
    }

    if(mode === null ){localStorage.setItem('mode', 'dark');}
});



function Mode() {
    var mode = localStorage.getItem('mode')
    if(mode === 'dark'){
        localStorage.setItem('mode', 'light');
        // change background to light and remove dark mode
        document.getElementById("Content").classList.add('bg-white');
        document.getElementById("Content").classList.remove('dark');

        document.getElementById("navbar").classList.add('dark');

        // change cards panel to light and remove dark mode
        var courses = document.querySelectorAll('.card');

        courses.forEach(function(course){
            course.classList.add('bg-dark');
            course.classList.remove('bg-light');
            course.classList.add('text-light');
            course.classList.remove('text-dark');
        }); 
    }
    
    
    if(mode === 'light'){
        localStorage.setItem('mode', 'dark');

        document.getElementById("Content").classList.remove('bg-white');
        document.getElementById("Content").classList.add('dark');

        document.getElementById("navbar").classList.remove('dark');

        // change cards panel to light and remove dark mode
        var courses = document.querySelectorAll('.card');

        courses.forEach(function(course){
            course.classList.remove('bg-dark');
            course.classList.add('bg-light');
            course.classList.remove('text-light');
            course.classList.add('text-dark');

        });        
    }
}