Select CustomerID from goldloanapplication where goldloanapplication.GoldLoanStatus='pending' and CustomerID ='2' UNION
select CustomerID from loanapplication where (CustomerID='2' OR Gaurantor1Id='2' and Gaurantor1Id='2') and loanapplication.LoanStatus='pendiing' UNION
select CustomerID from loan where (CustomerID='2' OR Gaurantor1Id='2' and Gaurantor1Id='2') and status='Active'