# learnability-emergence
Data and analysis code for artificial language project (Davis and Smith forthcoming). 

Within each experiment folder you can find the original data files and analysis code. The workflow is as follows: 

allDataAnon and prepList files are analyzed through the "analysis" R markup file. This outputs the allDataWriteMerged file. 
allDataWriteMerged is run through the python code "array to caption syntax orders" to generate a list of strings in all possible grammars: allDataWriteMergedGrammars
This grammar file is used as input to the second R markup file (analysis grammars)
